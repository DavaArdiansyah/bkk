<?php

namespace App\Http\Controllers;

use App\Imports\AlumniImport;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class DataAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumni = Alumni::all();
        return view ('data-alumni.index', compact('alumni'));
    }

    /**
     * Show the form for importing a new resource.
     */
    public function import()
    {
        return view ('data-alumni.import');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = public_path('storage/tmp/files/');
        $files = $request->input('files');

        try {
            foreach ($files as $file) {
                Excel::import(new AlumniImport, $path . '/' . $file);
                Storage::delete("public/tmp/files/" . $file);
            }
            return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil di impor.']);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errorMessages = [];
            foreach ($errors as $messages) {
                if (is_array($messages)) {
                    $errorMessages[] = implode(', ', $messages);
                }
            }
            return redirect()->back()->with(['toast' => 'true', 'status' => 'error', 'message' => 'Kesalahan validasi: '. implode('', $errorMessages)]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['toast' => 'true', 'status' => 'error', 'message' => 'Terjadi kesalahan saat mengimpor file.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumni)
    {
        return view ('data-alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumni $alumni)
    {
        $nik = $request->input('nik');
        if (Alumni::where('nik', $nik)->where('nik', '!=', $alumni->nik)->exists()) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'NIK sudah ada.']);
        }

        $alumni->nik = $request->input('nik');
        $alumni->nama = $request->input('nama');
        $alumni->jenis_kelamin = $request->input('jenis-kelamin');
        $alumni->jurusan = $request->input('jurusan');
        $alumni->tahun_lulus = $request->input('tahun-lulus');

        if (!$alumni->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui']);
        }

        $alumni->save();

        return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumni)
    {
        //
    }
}
