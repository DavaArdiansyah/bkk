<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WilayahController;
use App\Http\Requests\PendidikanNonFormalRequest;
use App\Models\Aktivitas;
use App\Models\Alumni;
use App\Models\PendidikanNonFormal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendidikanNonFormalController extends Controller
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
        return view('profil.alumni.pendidikan-non-formal', compact('provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendidikanNonFormalRequest $request)
    {
        $alumni = Alumni::where('username', Auth::user()->username)->first();
        PendidikanNonFormal::create([
            'nik' => $alumni->nik,
            'nama_lembaga' => $request->input('nama-lembaga'),
            'alamat' => $this->wilayahController->alamatLengkap($request),
            'nama_kursus' => $request->input('nama-kursus'),
            'tanggal' => Carbon::parse($request->input('tanggal'))->format('Y-m-d H:i:s'),
        ]);

        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Menambahkan data riwayat pendidikan non formal',
        ]);

        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(PendidikanNonFormal $pendidikanNonFormal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendidikanNonFormal $pendidikanNonFormal)
    {
        $provinsi = $this->wilayahController->provinsi();
        $alamat = $this->wilayahController->alamat($pendidikanNonFormal->alamat);
        return view('profil.alumni.pendidikan-non-formal', compact('provinsi', 'alamat', 'pendidikanNonFormal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PendidikanNonFormalRequest $request, PendidikanNonFormal $pendidikanNonFormal)
    {
        $pendidikanNonFormal->nama_lembaga = $request->input('nama-lembaga');
        $pendidikanNonFormal->alamat = $this->wilayahController->alamatLengkap($request);
        $pendidikanNonFormal->nama_kursus = $request->input('nama-kursus');
        $pendidikanNonFormal->tanggal = $request->input('tanggal');

        if (!$pendidikanNonFormal->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui']);
        }

        $pendidikanNonFormal->save();
        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Memperbaharui data riwayat pendidikan non formal',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendidikanNonFormal $pendidikanNonFormal)
    {
        $pendidikanNonFormal->delete();
        return redirect()->route('profil')->with(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
    }
}
