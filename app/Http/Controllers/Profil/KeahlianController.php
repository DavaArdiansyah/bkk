<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeahlianController extends Controller
{
    public function edit (Alumni $alumni) {
        return view ('profil.alumni.keahlian', compact('alumni'));
    }

    public function update (Alumni $alumni, Request $request) {
        $alumni->keahlian = $request->input('keahlian');

        if (!$alumni->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        }

        $alumni->save();
        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Memperbaharui Data Alumni',
        ]);

        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }
}
