<?php

namespace App\Http\Controllers\Halaman;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WilayahController;
use App\Models\Aktivitas;
use App\Models\Alumni;
use App\Models\Kerja;
use App\Models\PendidikanFormal;
use App\Models\PendidikanNonFormal;
use App\Models\User;
use Carbon\Carbon;
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
            return view('profil.admin.index');
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
        }
    }

    public function edit(User $user)
    {
        $alamat = [];

        $provinsi = $this->wilayahController->provinsi();
        if ($user->alumni->alamat) {
            $alamat = $this->wilayahController->alamat($user->alumni->alamat);
        }
        return view('profil.alumni.edit', compact('user', 'provinsi', 'alamat'));
    }

    public function update(Request $request, user $user)
    {
        if ($request->input('file')) {
            if ($request->input('for') == 'Alumni') {
                $data = Alumni::find(Auth::user()->alumni->nik);
                $this->avatar($data, $request, 'Alumni');
                return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
            }
        }
        $user->alumni->alamat = $this->wilayahController->alamatLengkap($request);
        $user->alumni->kontak = $request->input('kontak');
        $user->alumni->deskripsi = $request->input('deskripsi');

        $username = $request->input('username');
        $password = $request->input('password-baru');

        if (User::where('username', $username)->where('username', '!=', $user->username)->exists()) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Username sudah ada.']);
        }

        $user->username = $username;

        if ($password) {
            $user->password = Hash::make($password);
        }

        if (!$user->alumni->isDirty() && !$user->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        }

        $user->alumni->save();
        $user->save();
        if ($user->save()) {
            Auth::logout();
            Auth::login($user);
            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Data Akun',
            ]);
        }
        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Memperbaharui Data Alumni',
        ]);

        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }

    public function avatar($data, $request, $for)
    {
        if ($for == 'Alumni') {
            Storage::delete('public/tmp/images/' . $data->foto);
            $data->nama_file_foto = $request->input('file');

            if (!$request->input('file')) {
                return redirect()->back()->with(['toast' => 'true', 'status' => 'info', 'message' => 'Tidak Ada Data Yang Diperbaharui']);
            }


            $data->save();
            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Foto Profil',
            ]);
        }
    }
}
