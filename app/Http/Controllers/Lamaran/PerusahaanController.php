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
        $perusahaan = Perusahaan::where('username', Auth::user()->username)->first();
        $loker = Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)->get();
        $lamaran = Lamaran::whereIn('status', ['Terkirim', 'Lolos Ketahap Selanjutnya'])->whereIn('id_lowongan_pekerjaan', $loker->pluck('id_lowongan_pekerjaan'))->get();

        return view('lamaran.perusahaan.terbaru', compact('lamaran'));
    }

    public function update(Request $request, Lamaran $lamaran)
    {
        $status = $request->input('status');
        $pesan = $request->input('pesan');
        $idLamaran = $lamaran->id_lamaran;
        $filePath = 'public/files/' . $idLamaran . $lamaran->alumni->nama . '.txt';

        if ($status !== 'Diterima' && $status !== 'Ditolak' && !$pesan) {
            return redirect()->back()->with(['status' => 'warning', 'message' => "Harap Tambahkan Pesan Untuk Pelamar."]);
        }

        $lamaran->update(['status' => $status]);

        if ($pesan) {
            Storage::put($filePath, $pesan);
            return redirect()->back()->with(['status' => 'success', 'message' => "Berhasil Mengubah Status Lamaran Menjadi: {$status} Dan Mengirimkan Pesan Kepada Pelamar."]);
        }

        return redirect()->back()->with(['status' => 'success', 'message' => "Berhasil Mengubah Status Lamaran Menjadi: {$status}."]);
    }

    public function arsip ()
    {
        $perusahaan = Perusahaan::where('username', Auth::user()->username)->first();
        $loker = Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)->get();
        $lamaran = Lamaran::whereIn('status', ['Diterima', 'Ditolak'])->whereIn('id_lowongan_pekerjaan', $loker->pluck('id_lowongan_pekerjaan'))->get();

        return view('lamaran.perusahaan.arsip', compact('lamaran'));
    }
}
