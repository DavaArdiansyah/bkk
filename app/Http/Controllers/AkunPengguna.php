<?php

namespace App\Http\Controllers;

use App\Http\Requests\AkunPengguna\AkunAdminRequest;
use App\Http\Requests\AkunPengguna\AkunPerusahaanRequest;
use App\Http\Requests\AkunPengguna\UpdateRequest;
use App\Models\Admin;
use App\Models\Aktivitas;
use App\Models\Perusahaan;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkunPengguna extends Controller
{
    protected $wilayahController;

    public function __construct(WilayahController $wilayahController)
    {
        $this->wilayahController = $wilayahController;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('data-akun-pengguna.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function perusahaan()
    {
        $perusahaan = Perusahaan::where('status', 'Aktif')->get();
        return view('data-akun-pengguna.perusahaan-create', compact('perusahaan'));
    }

    public function admin()
    {
        $provinsi = $this->wilayahController->provinsi();
        return view('data-akun-pengguna.admin-create', compact('provinsi'));
    }

    public function akunPerusahaan(AkunPerusahaanRequest $request)
    {
        User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => 'Perusahaan',
            'id_data_perusahaan' => $request->input('id-data-perusahaan'),
        ]);

        return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil ditambahkan.']);
    }


    public function akunAdmin(AkunAdminRequest $request)
    {
        $user = User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => 'Admin BKK',
        ]);

        Admin::create([
            'nip' => $request->input('nip'),
            'username' => $user->username,
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis-kelamin'),
            'alamat' => $this->wilayahController->alamatlengkap($request),
            'kontak' => $request->input('kontak'),
            'nama_file_foto' => $request->input('file'),
        ]);

        return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil ditambahkan.']);
    }

    public function show(User $user)
    {
        $aktivitas = Aktivitas::where('username', $user->username)->get();
        return view('data-akun-pengguna.show', compact('aktivitas'));
    }

    public function edit(User $user)
    {
        if ($user->role == 'Perusahaan') {
            $perusahaan = Perusahaan::where('status', 'Aktif')->get();
            return view ('data-akun-pengguna.edit', compact('user', 'perusahaan'));
        }
        return view('data-akun-pengguna.edit', compact('user'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->username = $request->input('username');
        if ($request->input('password-baru')) {
            $user->password = Hash::make($request->input('password-baru'));
        }

        if (!$user->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        }

        $user->save();

        return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }

    public function status (Request $request, User $user)
    {
        $user->admin->status = $request->input('status');
        $user->admin->save();

        if ($user->admin->status == 'Tidak Aktif' && $user == Auth::user()) {
            Auth::logout($user);
            return redirect()->route('login')->with(['status' => 'warning', 'message' => 'Anda bukan admin lagi.']);
        }

        return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }

    public function destroy(User $user)
    {
        //
    }
}
