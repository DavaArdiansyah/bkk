<?php

namespace App\Http\Controllers\Halaman;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WilayahController;
use App\Models\Admin;
use App\Models\Aktivitas;
use App\Models\Alumni;
use App\Models\Kerja;
use App\Models\PendidikanFormal;
use App\Models\PendidikanNonFormal;
use App\Models\Perusahaan;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    protected $wilayahController;

    public function __construct(WilayahController $wilayahController)
    {
        $this->middleware('auth');
        $this->wilayahController = $wilayahController;
    }

    public function index()
    {
        if (Auth::user()->role == 'Admin BKK') {
            $admin = Admin::where('username', Auth::user()->username)->first();
            return view('profil.admin.index', compact('admin'));
        } elseif (Auth::user()->role == 'Alumni') {
            $alumni = Alumni::where('username', Auth::user()->username)->first();
            $pendidikanFormal = PendidikanFormal::where('nik', $alumni->nik)->orderby('tahun_awal', 'desc')->get();
            $pendidikanNonFormal = PendidikanNonFormal::where('nik', $alumni->nik)->orderby('tanggal', 'desc')->get();
            $pendidikanNonFormal->transform(function ($item) {
                $item->tanggal = Carbon::parse($item->tanggal)->format('j M Y');
                return $item;
            });
            $kerja = Kerja::where('nik', $alumni->nik)->orderby('tahun_awal', 'desc')->get();
            return view('profil.alumni.index', compact(['alumni', 'pendidikanFormal', 'pendidikanNonFormal', 'kerja']));
        } elseif (Auth::user()->role == 'Perusahaan') {
            $perusahaan = Perusahaan::where('username', Auth::user()->username)->first();
            return view('profil.perusahaan.index', compact('perusahaan'));
        }
    }

    public function edit(User $user)
    {
        $alamat = [];

        $provinsi = $this->wilayahController->provinsi();
        if ($user->alumni?->alamat) {
            $alamat = $this->wilayahController->alamat($user->alumni->alamat);
            return view('profil.alumni.edit', compact('user', 'provinsi', 'alamat'));
        } elseif ($user->perusahaan?->alamat) {
            $alamat = $this->wilayahController->alamat($user->perusahaan->alamat);
            return view('profil.perusahaan.edit', compact('user', 'provinsi', 'alamat'));
        } elseif ($user->admin->alamat) {
            $alamat = $this->wilayahController->alamat($user->admin->alamat);
            return view('profil.admin.edit', compact('user', 'provinsi', 'alamat'));
        }
    }

    public function update(Request $request, user $user)
    {
        if ($request->input('file')) {
            if ($request->input('for') == 'Alumni') {
                $data = Alumni::find(Auth::user()->alumni->nik);
                $this->avatar($data, $request, 'Alumni');
                return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
            } elseif ($request->input('for') == 'Perusahaan') {
                $data = Perusahaan::find(Auth::user()->perusahaan->id_data_perusahaan);
                $this->avatar($data, $request, 'Perusahaan');
                return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
            } elseif ($request->input('for') == 'Admin BKK') {
                $data = Admin::find(Auth::user()->admin->nip);
                $this->avatar($data, $request, 'Admin BKK');
                return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
            }
        }

        if ($request->input('for')) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        }

        if ($user->alumni) {
            $user->alumni->alamat = $this->wilayahController->alamatLengkap($request);
            $user->alumni->kontak = $request->input('kontak');
            $user->alumni->deskripsi = $request->input('deskripsi');
        } elseif ($user->perusahaan) {
            $user->perusahaan->alamat = $this->wilayahController->alamatLengkap($request);
            $user->perusahaan->bidang_usaha = $request->input('bidang-usaha');
            $user->perusahaan->no_telepon = $request->input('no-telepon');
        } elseif ($user->admin) {
            $user->admin->nama = $request->input('nama');
            $user->admin->jenis_kelamin = $request->input('jenis-kelamin');
            $user->admin->kontak = $request->input('kontak');
            $user->admin->alamat = $this->wilayahController->alamatLengkap($request);
        }

        $username = $request->input('username');
        $passwordBaru = $request->input('password-baru');
        $konfirmasiPassword = $request->input('konfirmasi-password');
        $passwordSaatIni = $request->input('password-saat-ini');

        if ($username != $user->username) {
            $client = new Client();
            $hunter_api_key = env('HUNTER_API_KEY');
            $result = $client->get("https://api.hunter.io/v2/email-verifier?email={$username}&api_key={$hunter_api_key}");
            $status = json_decode($result->getBody(), true)['data']['status'];

            if ($status == 'invalid') {
                return redirect()->back()->with(['status' => 'error', 'message' => 'Email tidak valid.']);
            }
        }

        if (User::where('username', $username)->where('username', '!=', $user->username)->exists()) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Username sudah ada.']);
        }

        $user->username = $username;


        if ($passwordBaru || $konfirmasiPassword || $passwordSaatIni) {
            if (!$konfirmasiPassword) {
                return redirect()->back()->with(['status' => 'error', 'message' => 'Konfirmasi password harus diisi.']);
            }

            if ($passwordBaru !== $konfirmasiPassword) {
                return redirect()->back()->with(['status' => 'error', 'message' => 'Konfirmasi password harus sama dengan password baru.']);
            }

            if (!$passwordSaatIni) {
                return redirect()->back()->with(['status' => 'error', 'message' => 'Password saat ini harus diisi.']);
            }

            $user->password = Hash::make($passwordBaru);
        }

        if ($user->alumni && !$user->alumni->isDirty() && !$user->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        } elseif ($user->perusahaan && !$user->perusahaan->isDirty() && !$user->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        } elseif ($user->admin && !$user->admin->isDirty() && !$user->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        }

        if ($user->alumni) {
            $user->alumni->save();
        } elseif ($user->perusahaan) {
            $user->perusahaan->save();
        } elseif ($user->admin) {
            $user->admin->save();
        }

        $user->save();
        if ($user->save()) {
            Auth::logout();
            Auth::login($user);
            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Data Akun',
            ]);
        }

        if ($user->alumni) {
            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Data Alumni',
            ]);
        } elseif ($user->perusahaan) {
            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Data Perusahaan',
            ]);
        } elseif ($user->admin) {
            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Data Admin BKK',
            ]);
        }

        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }

    public function avatar($data, $request, $for)
    {
        if ($for == 'Alumni' | $for == 'Admin BKK') {
            Storage::delete('public/images/' . $data->nama_file_foto);
            $data->nama_file_foto = $request->input('file');
        } elseif ($for == 'Perusahaan') {
            Storage::delete('public/images' . $data->nama_file_logo);
            $data->nama_file_logo = $request->input('file');
        }

        $data->save();

        if ($for == 'Alumni' | $for == 'Admin BKK') {
            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Foto Profil',
            ]);
        } elseif ($for == 'Perusahaan') {
            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Logo',
            ]);
        }
    }
}
