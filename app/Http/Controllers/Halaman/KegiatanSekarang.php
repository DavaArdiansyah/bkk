<?php

namespace App\Http\Controllers\Halaman;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanSekarang extends Controller
{
    public function edit (){
        $alumni = Alumni::find(Auth::user()->alumni->nik);
        return view ('kegiatan-sekarang', compact('alumni'));
    }

    public function update (Request $request, Alumni $alumni) {
        $alumni->status = $request->input('kegiatan-sekarang');

        if (!$alumni->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        }
        $alumni->save();

        return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }
}
