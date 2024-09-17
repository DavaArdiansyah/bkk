<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WilayahController;
use App\Models\Aktivitas;
use App\Models\Alumni;
use App\Models\PendidikanFormal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendidikanFormalController extends Controller
{
    protected $wilayahController;

    public function __construct(WilayahController $wilayahController)
    {
        $this->wilayahController = $wilayahController;
    }
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
        $provinsi = $this->wilayahController->provinsi();
        return view('profil.alumni.pendidikan-formal', compact('provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alamat = $this->wilayahController->alamatLengkap($request);
        $alumni = Alumni::where('username', Auth::user()->username)->first();
        PendidikanFormal::create([
            'nik' => $alumni->nik,
            'nama_sekolah' => $request->input('nama-sekolah'),
            'alamat' => $alamat,
            'bidang_studi' => $request->input('bidang-studi'),
            'tahun_awal' => $request->input('tahun-awal'),
            'tahun_akhir' => $request->input('tahun-akhir'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Menambahkan Data Riwayat Pendidikan Formal',
        ]);

        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(PendidikanFormal $pendidikanFormal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendidikanFormal $pendidikanFormal)
    {
        $provinsi = $this->wilayahController->provinsi();
        $alamat = $this->wilayahController->alamat($pendidikanFormal->alamat);
        return view('profil.alumni.pendidikan-formal', compact('provinsi', 'alamat', 'pendidikanFormal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PendidikanFormal $pendidikanFormal)
    {
        $alamat = $this->wilayahController->alamatLengkap($request);

        $pendidikanFormal->nama_sekolah = $request->input('nama-sekolah');
        $pendidikanFormal->alamat = $alamat;
        $pendidikanFormal->bidang_studi = $request->input('bidang-studi');
        $pendidikanFormal->tahun_awal = $request->input('tahun-awal');
        $pendidikanFormal->tahun_akhir = $request->input('tahun-akhir');
        $pendidikanFormal->deskripsi = $request->input('deskripsi');

        if (!$pendidikanFormal->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui']);
        }

        $pendidikanFormal->save();
        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Memperbaharui Data Riwayat Pendidikan Formal',
        ]);

        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendidikanFormal $pendidikanFormal)
    {
        $pendidikanFormal->delete();
        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
    }
}
