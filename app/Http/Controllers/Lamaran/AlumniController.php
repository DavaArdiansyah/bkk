<?php

namespace App\Http\Controllers\Lamaran;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\FileLamaran;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $lamaran = Lamaran::create([
            'id_lowongan_pekerjaan' => $request->input('id-lowongan-pekerjaan'),
            'nik' => Alumni::where('username', Auth::user()->username)->first()->nik,
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
