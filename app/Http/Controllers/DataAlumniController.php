<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataAlumni\StoreRequest;
use App\Http\Requests\DataAlumni\UpdateRequest;
use App\Imports\AlumniImport;
use App\Models\Alumni;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class DataAlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::all();
        return view('data-alumni.index', compact('alumni'));
    }

    public function import()
    {
        return view('data-alumni.import');
    }

    public function store(StoreRequest $request)
    {
        $request->validate(['files' => 'required'], ['files.required' => 'Wajib mengunggah file.']);
        $path = public_path('storage/tmp/files/');
        $files = $request->input('files');

        foreach ($files as $file) {
            try {
                Excel::import(new AlumniImport, $path . '/' . $file);
                Storage::delete("public/tmp/files/" . $file);
                return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil di impor.']);
            } catch (ValidationException $e) {
                $errors = $e->errors();
                $errorMessages = [];
                foreach ($errors as $messages) {
                    if (is_array($messages)) {
                        $errorMessages[] = implode(', ', $messages);
                    }
                }
                Storage::delete("public/tmp/files/" . $file);
                return redirect()->back()->with(['toast' => 'true', 'status' => 'error', 'message' => 'Kesalahan validasi: ' . implode('', $errorMessages)]);
            } catch (\Exception $e) {
                Storage::delete("public/tmp/files/" . $file);
                return redirect()->back()->with(['toast' => 'true', 'status' => 'error', 'message' => 'Terjadi kesalahan saat mengimpor file.']);
            }
        }
    }

    public function show(Alumni $alumni)
    {
        //
    }

    public function edit(Alumni $alumni)
    {
        return view('data-alumni.edit', compact('alumni'));
    }

    public function update(UpdateRequest $request, Alumni $alumni)
    {
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

    public function destroy(Alumni $alumni)
    {
        //
    }
}
