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
        $lamaran = Lamaran::where('nik', Alumni::where('username', Auth::user()->username)->value('nik'))->orderBy('waktu', 'desc')->get();
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
        if ($alumni->alamat == null || $alumni->keahlian || $alumni->deskripsi) {
            return redirect()->back()->with(['status' => 'warning', 'message' => 'Harap lengkapi informasi utama terlebih dahulu.']);
        }
        $lamaran = Lamaran::create([
            'id_lowongan_pekerjaan' => $request->input('id-lowongan-pekerjaan'),
            'nik' => Alumni::where('username', Auth::user()->username)->first()->nik,
        ]);

        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Melamar pekerjaan',
        ]);

        if ($request->input('file')) {
            foreach ($request->input('file') as $file) {
                FileLamaran::create([
                    'id_lamaran' => $lamaran->id_lamaran,
                    'nama_file' => $file
                ]);;
            }
        }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lamaran $lamaran)
    {
        //
    }
}
