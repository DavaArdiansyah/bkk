<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataPerusahaan\ImportRequest;
use App\Http\Requests\DataPerusahaan\StoreRequest;
use App\Http\Requests\DataPerusahaanRequest;
use App\Imports\PerusahaanImport;
use App\Models\Loker;
use App\Models\Perusahaan;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class DataPerusahaanController extends Controller
{
    protected $wilayahController;

    public function __construct(WilayahController $wilayahController)
    {
        $this->wilayahController = $wilayahController;
    }

    public function index()
    {
        $perusahaan = Perusahaan::all();
        return view('data-perusahaan.index', compact('perusahaan'));
    }

    public function create()
    {
        $provinsi = $this->wilayahController->provinsi();
        return view('data-perusahaan.create', compact('provinsi'));
    }

    public function tmp(DataPerusahaanRequest $request)
    {
        session([
            'nama' => $request->input('nama') ?? session('nama'),
            'bidang-usaha' => $request->input('bidang-usaha') ?? session('bidang-usaha'),
            'no-telepon' => $request->input('no-telepon') ?? session('no-telepon'),
            'alamat' => $this->wilayahController->alamatlengkap($request) ?? session('alamat'),
            'nama-file-logo' => $request->input('file') ?? session('nama-file-logo'),
        ]);

        return redirect()->route('admin.data-perusahaan.akun.create');
    }

    public function akun()
    {
        if (session('nama') !== null) {
            return view('data-perusahaan.akun');
        } else {
            return redirect()->route('admin.data-perusahaan.create')->with(['status' => 'error', 'message' => 'Hey itu ilegal!']);
        }
    }

    public function import(ImportRequest $request)
    {
        $path = public_path('storage/tmp/files/');
        $files = $request->input('files');

        foreach ($files as $file) {
            try {
                Excel::import(new PerusahaanImport, $path . '/' . $file);
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

    public function store(StoreRequest $request)
    {
        try {
            $perusahaan = Perusahaan::create([
                'nama' => session('nama'),
                'bidang_usaha' => session('bidang-usaha'),
                'no_telepon' => session('no-telepon'),
                'alamat' => session('alamat'),
                'nama_file_logo' => session('nama-file-logo'),
            ]);

            session()->forget(['nama', 'bidang-usaha', 'no-telepon', 'alamat', 'nama-file-logo']);

            User::create([
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'role' => 'Perusahaan',
                'id_data_perusahaan' => $perusahaan->id_data_perusahaan,
            ]);
        } catch (\Exception) {
            return redirect()->route('admin.data-perusahaan.create')->with(['status' => 'error', 'message' => 'Harap tidak melewati proses yang ada.']);
        }

        return redirect()->route('admin.data-perusahaan.create')->with(['status' => 'success', 'message' => 'Data berhasil ditambahkan.']);
    }

    public function show(Perusahaan $perusahaan)
    {
        //
    }

    public function edit(Perusahaan $perusahaan)
    {
        $alamat = $this->wilayahController->alamat($perusahaan->alamat);
        $provinsi = $this->wilayahController->provinsi();
        return view('data-perusahaan.edit', compact('perusahaan', 'alamat', 'provinsi'));
    }

    public function update(DataPerusahaanRequest $request, Perusahaan $perusahaan)
    {
        $perusahaan->nama = $request->input('nama');
        $perusahaan->bidang_usaha = $request->input('bidang-usaha');
        $perusahaan->no_telepon = $request->input('no-telepon');
        $perusahaan->alamat = $this->wilayahController->alamatlengkap($request);
        if ($request->input('file')) {
            $perusahaan->nama_file_logo = $request->input('file');
        }

        if (!$perusahaan->isDirty()) {
            return redirect()->back()->with(['status' => 'info', 'message' => 'Tidak ada data yang diperbaharui.']);
        }

        $perusahaan->save();

        return redirect()->back()->with(['status' => 'success', 'message' => 'Data berhasil diperbaharui.']);
    }

    public function status(Request $request, Perusahaan $perusahaan)
    {
        $perusahaan->update(['status' => $request->input('status')]);
        if ($perusahaan->status == 'Tidak Aktif') {
            Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)->update(['status' => 'Tidak Dipublikasi']);
        }
        return redirect()->back()->with(['status' => 'success', 'message' => "Status perusahaan berhasil diubah menjadi {$request->input('status')}"]);
    }

    public function destroy(Perusahaan $perusahaan)
    {
        //
    }
}
