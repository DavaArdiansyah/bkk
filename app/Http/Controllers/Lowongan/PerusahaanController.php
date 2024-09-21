<?php

namespace App\Http\Controllers\Lowongan;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Loker;
use App\Models\Perusahaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loker = Loker::all();
        $loker->transform(function ($item) {
            $item->tanggal_akhir = Carbon::parse($item->tanggal_akhir)->format('j M Y H:i');
            return $item;
        });
        foreach ($loker as $lk) {
            $fileName = 'public/files/' . $lk->id_lowongan_pekerjaan . $lk->perusahaan->nama . '.txt';
            $lk['pesan'] = Storage::exists($fileName) ? Storage::get($fileName) : 'Pesan Tidak Ditemukan.';
        }
        return view ('lowongan.perusahaan.index', compact('loker'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('lowongan.perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Loker::create([
            'id_data_perusahaan' => Perusahaan::where('username', Auth::user()->username)->first()->id_data_perusahaan,
            'jabatan' => $request->input('jabatan'),
            'jenis_waktu_pekerjaan' => $request->input('jenis-waktu-pekerjaan'),
            'tanggal_akhir' => Carbon::parse($request->input('tanggal-akhir'))->format('Y-m-d H:i:s'),
            'deskripsi' => $request->input('deskripsi')
        ]);

        Aktivitas::create([
            'username' => Auth::user()->username,
            'keterangan' => 'Menambahkan Info Lowongan',
        ]);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil diajukan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Loker $loker)
    {
        $loker->tanggal_akhir = Carbon::parse($loker->tanggal_akhir)->format('j M Y H:i');
        return view ('lowongan.perusahaan.show', compact('loker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loker $loker)
    {
        return view ('lowongan.perusahaan.edit', compact('loker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loker $loker)
    {
        if ($request->input('status')) {
            $loker->update(['status' => $request->input('status')]);
            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Info Lowongan',
            ]);
            return redirect()->back()->with(['toast' => 'true','status' => 'success','message' => 'Berhasil mengubah status info loker menjadi: Tidak Dipublikasi.']);
        } else {
            $loker->jabatan = $request->input('jabatan');
            $loker->jenis_waktu_pekerjaan = $request->input('jenis-waktu-pekerjaan');
            $loker->tanggal_akhir = Carbon::parse($request->input('tanggal-akhir'))->format('Y-m-d H:i:s');
            $loker->deskripsi = $request->input('deskripsi');

            if (!$loker->isDirty()) {
                return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak Ada Data Yang Diperbaharui']);
            }

            $loker->status = 'Tertunda';
            $loker->save();

            Aktivitas::create([
                'username' => Auth::user()->username,
                'keterangan' => 'Memperbaharui Info Lowongan',
            ]);

            return redirect()->route('perusahaan.info-lowongan.index')->with(['status' => 'success', 'message' => 'Data Berhasil Diperbaharui Dan Telah Diajuakan Kembali.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loker $loker)
    {
        //
    }
}
