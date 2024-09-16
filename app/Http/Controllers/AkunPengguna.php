<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunPengguna extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'Admin BKK')->get();
        return view('data-akun-pengguna.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $username = $request->input('username');
        $password = $request->input('password-baru');

        if (User::where('username', $username)->where('username', '!=', $user->username)->exists()) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Username sudah ada.']);
        }

        $user->username = $username;

        if ($password) {
            $user->password = Hash::make($password);
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
