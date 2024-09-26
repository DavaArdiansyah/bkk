<?php

namespace App\Http\Controllers;

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
        return view('data-akun-pengguna.create');
    }

    public function perusahaan()
    {
        $perusahaan = Perusahaan::where('status', 'Aktif')->get();
        return view ('data-akun-pengguna.perusahaan-create', compact('perusahaan'));
    }

    public function admin()
    {
        $provinsi = $this->wilayahController->provinsi();
        return view('data-akun-pengguna.admin-create', compact('provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->input('role') == 'Admin') {
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
        } elseif ($request->input('role') == 'Perusahaan') {
            return $request;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $aktivitas = Aktivitas::where('username', $user->username)->get();
        return view('data-akun-pengguna.show', compact('aktivitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('data-akun-pengguna.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($request->input('status')) {
            $user->admin->status = $request->input('status');
            $user->admin->save();

            if ($user->admin->status == 'Tidak Aktif' && $user == Auth::user()) {
                Auth::logout($user);
                return redirect()->route('login')->with(['status' => 'warning', 'message' => 'Anda bukan admin lagi.']);
            }

            return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
        }

        $username = $request->input('username');
        $passwordBaru = $request->input('password-baru');
        $konfirmasiPassword = $request->input('konfirmasi-password');

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

        if ($passwordBaru || $konfirmasiPassword) {
            if (!$konfirmasiPassword) {
                return redirect()->back()->with(['status' => 'error', 'message' => 'Konfirmasi password harus diisi.']);
            }

            if ($passwordBaru !== $konfirmasiPassword) {
                return redirect()->back()->with(['status' => 'error', 'message' => 'Konfirmasi password harus sama dengan password baru.']);
            }

            $user->password = Hash::make($passwordBaru);
        }

        if (!$user->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        }

        $user->save();

        return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
