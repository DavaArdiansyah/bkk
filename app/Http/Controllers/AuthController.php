<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function login(Request $request)
    {
        $user = User::find($request->input('username'));
        if (!$user) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Username tidak terdaftar pada aplikasi.']);
        }
        if ($user->perusahaan) {
            $perusahaan = Perusahaan::find($user->perusahaan->id_data_perusahaan);
            if ($user->role == 'Perusahaan' && $perusahaan->status == 'Tidak Aktif') {
                return redirect()->back()->with(['status' => 'error', 'message' => 'Username tidak terdaftar pada aplikasi.']);
            }
        } elseif ($user->admin) {
            $admin = Admin::find($user->admin->nip);
            if ($user->role == 'Admin BKK' && $admin->status == 'Tidak Aktif') {
                return redirect()->back()->with(['status' => 'error', 'message' => 'Username tidak terdaftar pada aplikasi.']);
            }
        }
        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Password yang anda masukan salah.']);
        }
        Auth::login($user);
        return redirect()->route('dashboard')->with(['status' => 'success', 'message' => 'Login berhasil!']);
    }

    public function logout()
    {
        Auth::logout(Auth::user());
        return redirect()->route('login');
    }
}
