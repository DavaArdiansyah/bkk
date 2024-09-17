<?php

namespace App\Http\Controllers\Lowongan;

use App\Http\Controllers\Controller;
use App\Models\Loker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loker = Loker::all();
        return view ('lowongan.admin.index', compact('loker'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Loker $loker)
    {
        return view ('lowongan.admin.show', compact('loker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loker $loker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loker $loker)
    {
        $loker->update(['status' => $request->input('status')]);

        if ($request->input('pesan')) {
            Storage::delete("public/files/" . $loker->id_lowongan_pekerjaan . $loker->perusahaan->nama);
            Storage::put("public/files/" . $loker->id_lowongan_pekerjaan . $loker->perusahaan->nama . '.txt', $request->input('pesan'));
            return redirect()->back()->with(['status' => 'success', 'message' => "Berhasil mengubah status lowongan menjadi: {$request->input('status')} dan mengirimkan pesan kepada perusahaan terkait."]);;
        }
        return redirect()->back()->with(['status' => 'success', 'message' => "Berhasil mengubah status lowongan menjadi: {$request->input('status')}."]);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loker $loker)
    {
        //
    }
}