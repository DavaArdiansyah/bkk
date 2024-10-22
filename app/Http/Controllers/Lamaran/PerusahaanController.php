<?php

namespace App\Http\Controllers\Lamaran;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Loker;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{
    public function terbaru()
    {
        $perusahaan = Perusahaan::find(Auth::user()->id_data_perusahaan);
        $loker = Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)->get();
        $lamaran = Lamaran::whereIn('status', ['Terkirim', 'Lolos Ketahap Selanjutnya'])->whereIn('id_lowongan_pekerjaan', $loker->pluck('id_lowongan_pekerjaan'))->get();

        return view('lamaran.perusahaan.terbaru', compact('lamaran'));
    }

    public function update(Request $request, Lamaran $lamaran)
    {

        if (!$request->input('pesan')) {
            return back()->with(['status' => 'error', 'message' =>  'Pesan wajib diisi.'])->withErrors(['pesan' => 'Pesan wajib diisi.'])->withInput();
        }

        $status = $request->input('status');
        $pesan = $request->input('pesan');
        $filePath = 'public/files/' . $lamaran->id_lamaran . $lamaran->alumni->nama . '.txt';

        $lamaran->update(['status' => $status]);
        Storage::put($filePath, $pesan);
        return redirect()->back()->with(['status' => 'success', 'message' => "Berhasil Mengubah Status Lamaran Menjadi: {$status} Dan Mengirimkan Pesan Kepada Pelamar."]);
    }

    public function arsip()
    {
        $perusahaan = Perusahaan::find(Auth::user()->id_data_perusahaan);
        $loker = Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)->get();
        $lamaran = Lamaran::whereIn('status', ['Diterima', 'Ditolak'])->whereIn('id_lowongan_pekerjaan', $loker->pluck('id_lowongan_pekerjaan'))->get();

        return view('lamaran.perusahaan.arsip', compact('lamaran'));
    }
}
