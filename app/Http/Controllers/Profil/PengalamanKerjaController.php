<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WilayahController;
use App\Models\Aktivitas;
use App\Models\Alumni;
use App\Models\Kerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengalamanKerjaController extends Controller
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
        return view('profil.alumni.kerja', compact('provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alamat = $this->wilayahController->alamatLengkap($request);
        $alumni = Alumni::where('username', Auth::user()->username)->first();
        Kerja::create([
            'nik' => $alumni->nik,
            'jabatan' => $request->input('jabatan'),
            'jenis_waktu_pekerjaan' => $request->input('jenis-waktu-pekerjaan'),
            'nama_perusahaan' => $request->input('nama-perusahaan'),
            'alamat' => $alamat,
            'tahun_awal' => $request->input('tahun-awal'),
            'tahun_akhir' => $request->input('tahun-akhir'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Menambahkan Data Pengalaman kerja',
        ]);

        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kerja $kerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kerja $kerja)
    {
        $provinsi = $this->wilayahController->provinsi();
        $alamat = $this->wilayahController->alamat($kerja->alamat);
        return view('profil.alumni.kerja', compact('provinsi', 'alamat', 'kerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kerja $kerja)
    {
        $alamat = $this->wilayahController->alamatLengkap($request);

        $kerja->jabatan = $request->input('jabatan');
        $kerja->nama_perusahaan = $request->input('nama-perusahaan');
        $kerja->jenis_waktu_pekerjaan = $request->input('jenis-waktu-pekerjaan');
        $kerja->alamat = $alamat;
        $kerja->tahun_awal = $request->input('tahun-awal');
        $kerja->tahun_akhir = $request->input('tahun-akhir');
        $kerja->deskripsi = $request->input('deskripsi');

        if (!$kerja->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui']);
        }

        $kerja->save();
        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Memperbaharui Data Pengalaman Kerja',
        ]);

        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kerja $kerja)
    {
        $kerja->delete();
        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
    }
}
