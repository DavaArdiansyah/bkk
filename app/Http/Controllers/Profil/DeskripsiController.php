<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeskripsiRequest;
use App\Models\Aktivitas;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeskripsiController extends Controller
{
    public function edit(Alumni $alumni)
    {
        return view ('profil.alumni.deskripsi', compact('alumni'));
    }

    public function update(DeskripsiRequest $request, Alumni $alumni)
    {
        $alumni->deskripsi = $request->input('deskripsi');

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

    public function destroy(Alumni $alumni)
    {
        $alumni->deskripsi = null;
        $alumni->save();
        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
    }
}
