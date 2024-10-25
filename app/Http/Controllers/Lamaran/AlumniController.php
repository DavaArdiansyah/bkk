<?php

namespace App\Http\Controllers\Lamaran;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Alumni;
use App\Models\FileLamaran;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lamaran = Lamaran::where('nik', Auth::user()->alumni->nik)->orderBy('waktu', 'desc')->get();
        foreach ($lamaran as $lm) {
            $fileName = 'public/files/' . $lm->id_lamaran . $lm->alumni->nama . '.txt';
            $lm['pesan'] = Storage::exists($fileName) ? Storage::get($fileName) : 'Pesan Tidak Ditemukan.';
        }
        return view('lamaran.alumni.index', compact('lamaran'));
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
        $alumni = Alumni::find(Auth::user()->alumni->nik);
        if (Auth::user()->username == $alumni->nik) {
            return redirect()->back()->with(['status' => 'warning', 'message' => 'Harap ganti username menjadi email yang valid terlebih dahulu.']);
        }
        if ($alumni->alamat == null || $alumni->kontak == null || $alumni->keahlian == null || $alumni->nama_file_foto == null || $alumni->deskripsi == null || $alumni->pendidikanFormal->isEmpty()) {
            if ($request->input('files')) {
                foreach ($request->input('files') as $file) {
                    Storage::delete("public/tmp/files/" . $file);
                }
            }
            return redirect()->back()->with(['status' => 'warning', 'message' => 'Harap lengkapi informasi utama terlebih dahulu.']);
        }
        $lamaran = Lamaran::create([
            'id_lowongan_pekerjaan' => $request->input('id-lowongan-pekerjaan'),
            'nik' => Alumni::where('username', Auth::user()->username)->first()->nik,
        ]);

        if ($request->input('files')) {
            foreach ($request->input('files') as $file) {
                FileLamaran::create([
                    'id_lamaran' => $lamaran->id_lamaran,
                    'nama_file' => $file
                ]);;
            }
        }

        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Melamar pekerjaan',
        ]);

        return redirect()->back()->with(['status' => 'success', 'message' => 'Anda berhasil melamar pekerjaan ini.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lamaran $lamaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lamaran $lamaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lamaran $lamaran)
    {
        $namaFiles = $lamaran->fileLamaran->pluck('nama_file')->toArray();

        foreach ($request->input('files') as $file) {
            if (!in_array($file, $namaFiles)) {
                FileLamaran::create([
                    'id_lamaran' => $lamaran->id_lamaran,
                    'nama_file' => $file,
                ]);
            }
        }

        foreach ($namaFiles as $namaFile) {
            if (!in_array($namaFile, $request->input('files'))) {
                FileLamaran::where('id_lamaran', $lamaran->id_lamaran)
                    ->where('nama_file', $namaFile)
                    ->delete();
            }
        }

        return redirect()->back()->with(['status' => 'success', 'message' => 'Anda berhasil memperbaharui dokumen lamaran.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lamaran $lamaran)
    {
        //
    }
}
