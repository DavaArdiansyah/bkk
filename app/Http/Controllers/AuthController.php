<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::find($request->input('username'));

        if (!$user) {
            return back()->withErrors(['username' => 'Username tidak terdaftar pada aplikasi.']);
        }

        if ($user->role == 'Perusahaan' && isset($user->perusahaan)) {
            $perusahaan = Perusahaan::find($user->perusahaan->id_data_perusahaan);
            if ($perusahaan && $perusahaan->status == 'Tidak Aktif') {
                return back()->withErrors(['username' => 'Akun perusahaan Anda tidak aktif.']);
            }
        }

        if ($user->role == 'Admin BKK' && isset($user->admin)) {
            $admin = Admin::find($user->admin->nip);
            if ($admin && $admin->status == 'Tidak Aktif') {
                return back()->withErrors(['username' => 'Akun admin Anda tidak aktif.']);
            }
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors(['password' => 'Password yang Anda masukkan salah.'])->withInput();
        }

        $firstLogin = $user->created_at->eq($user->updated_at);

        Auth::login($user);

        $user->touch();

        $messageLogin = ['status' => 'success', 'message' => 'Login berhasil!'];
        $messagePassword = ['status' => 'info', 'message' => 'Login berhasil!, harap ganti password Anda!'];

        return redirect()->route('dashboard')->with($firstLogin ? $messagePassword : $messageLogin);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
