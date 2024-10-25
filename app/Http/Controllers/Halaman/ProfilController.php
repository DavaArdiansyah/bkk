<?php

namespace App\Http\Controllers\Halaman;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WilayahController;
use App\Http\Requests\Profil\UpdateRequest;
use App\Models\Admin;
use App\Models\Aktivitas;
use App\Models\Alumni;
use App\Models\Kerja;
use App\Models\PendidikanFormal;
use App\Models\PendidikanNonFormal;
use App\Models\Perusahaan;
use App\Models\User;
use Carbon\Carbon;
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
            // return $alumni->deskripsi;
            $pendidikanFormal = PendidikanFormal::where('nik', $alumni->nik)->orderby('tahun_awal', 'desc')->get();
            $pendidikanNonFormal = PendidikanNonFormal::where('nik', $alumni->nik)->orderby('tanggal', 'desc')->get();
            $pendidikanNonFormal->transform(function ($item) {
                $item->tanggal = Carbon::parse($item->tanggal)->format('j M Y');
                return $item;
            });
            $kerja = Kerja::where('nik', $alumni->nik)->orderby('tahun_awal', 'desc')->get();
            return view('profil.alumni.index', compact(['alumni', 'pendidikanFormal', 'pendidikanNonFormal', 'kerja']));
        } elseif (Auth::user()->role == 'Perusahaan') {
            $perusahaan = Perusahaan::find(Auth::user()->id_data_perusahaan);
            return view('profil.perusahaan.index', compact('perusahaan'));
        }
    }

    public function edit(User $user)
    {
        $provinsi = $this->wilayahController->provinsi();
        if ($user->role == 'Alumni') {
            $alamat = $user->alumni->alamat ? $this->wilayahController->alamat($user->alumni->alamat) : [];
            return view('profil.alumni.edit', compact('user', 'provinsi', 'alamat'));
        } elseif ($user->role == 'Perusahaan') {
            $alamat = $user->perusahaan->alamat ? $this->wilayahController->alamat($user->perusahaan->alamat) : [];
            return view('profil.perusahaan.edit', compact('user', 'provinsi', 'alamat'));
        } elseif ($user->role == 'Admin BKK') {
            $alamat = $user->admin->alamat ? $this->wilayahController->alamat($user->admin->alamat) : [];
            return view('profil.admin.edit', compact('user', 'provinsi', 'alamat'));
        }
    }

    public function update(UpdateRequest $request, User $user)
    {
        if ($request->input('file')) {
            return $this->avatar($user, $request);
        }

        if ($user->role == 'Alumni') {
            $user->alumni->alamat = $this->wilayahController->alamatLengkap($request);
            $user->alumni->kontak = $request->input('kontak');
        } elseif ($user->role == 'Perusahaan') {
            $user->perusahaan->alamat = $this->wilayahController->alamatLengkap($request);
            $user->perusahaan->bidang_usaha = $request->input('bidang-usaha');
            $user->perusahaan->no_telepon = $request->input('no-telepon');
        } elseif ($user->role == 'Admin BKK') {
            $user->admin->nama = $request->input('nama');
            $user->admin->jenis_kelamin = $request->input('jenis-kelamin');
            $user->admin->kontak = $request->input('kontak');
            $user->admin->alamat = $this->wilayahController->alamatLengkap($request);
        }

        $user->username = $request->input('username');
        if ($request->input('password-baru')) {
            $user->password = Hash::make($request->input('password-baru'));
        }

        if (!$user->isDirty() && !($user->alumni && $user->alumni->isDirty()) && !($user->perusahaan && $user->perusahaan->isDirty()) && !($user->admin && $user->admin->isDirty())
        ) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        }

        if ($user->role == 'Alumni' && $user->alumni->isDirty()) {
            $user->alumni->save();
        } elseif ($user->role == 'Perusahaan' && $user->perusahaan->isDirty()) {
            $user->perusahaan->save();
        } elseif ($user->role == 'Admin BKK' && $user->admin->isDirty()) {
            $user->admin->save();
        }

        if ($user->isDirty(['username', 'password'])) {
            $user->save();
            Auth::logout();
            Auth::login($user);
            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Data Akun',
            ]);
        }

        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Memperbaharui Data ' . $user->role,
        ]);

        return redirect()->route('profil.edit', ['user' => $user])
            ->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }


    public function avatar($data, $request)
    {
        if ($data->role == 'Alumni') {
            if ($data->alumni->nama_file_foto === $request->input('file')) {
                return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
            }
            Storage::delete('public/images/' . $data->alumni->nama_file_foto);
            $data->alumni->nama_file_foto = $request->input('file');
            $data->alumni->save();
        } elseif ($data->role == 'Admin BKK') {
            if ($data->admin->nama_file_foto === $request->input('file')) {
                return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
            }
            Storage::delete('public/images/' . $data->admin->nama_file_foto);
            $data->admin->nama_file_foto = $request->input('file');
            $data->admin->save();
        } elseif ($data->role == 'Perusahaan') {
            if ($data->perusahaan->nama_file_logo === $request->input('file')) {
                return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
            }
            Storage::delete('public/images/' . $data->perusahaan->nama_file_logo);
            $data->perusahaan->nama_file_logo = $request->input('file');
            $data->perusahaan->save();
        }

        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Memperbaharui ' . ($data->role === 'Perusahaan' ? 'Logo' : 'Foto Profil'),
        ]);

        return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }
}
