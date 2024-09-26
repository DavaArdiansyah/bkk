<?php

namespace App\Http\Controllers;

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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perusahaan = Perusahaan::all();
        return view('data-perusahaan.index', compact('perusahaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinsi = $this->wilayahController->provinsi();
        return view('data-perusahaan.create', compact('provinsi'));
    }

    public function akun(Request $request)
    {
        $request = [
            'nama' => $request->input('nama'),
            'bidang-usaha' => $request->input('bidang-usaha'),
            'no-telepon' => $request->input('no-telepon'),
            'alamat' => $this->wilayahController->alamatlengkap($request),
            'nama-file-logo' => $request->input('file'),
        ];

        return view('data-perusahaan.akun', compact('request'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->input('files')) {
            $path = public_path('storage/tmp/files/');
            $files = $request->input('files');

            try {
                foreach ($files as $file) {
                    Excel::import(new PerusahaanImport, $path . '/' . $file);
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
                return redirect()->back()->with(['toast' => 'true', 'status' => 'error', 'message' => 'Kesalahan validasi: ' . implode('', $errorMessages)]);
            } catch (\Exception $e) {
                return redirect()->back()->with(['toast' => 'true', 'status' => 'error', 'message' => 'Terjadi kesalahan saat mengimpor file.']);
            }
        }
        $username = $request->input('username');

        $client = new Client();
        $hunter_api_key = env('HUNTER_API_KEY');
        $result = $client->get("https://api.hunter.io/v2/email-verifier?email={$username}&api_key={$hunter_api_key}");
        $status = json_decode($result->getBody(), true)['data']['status'];

        if ($status == 'invalid') {
            return redirect()->route('admin.data-perusahaan.create')->with(['status' => 'error', 'message' => 'Email tidak valid.']);
        }

        if (User::where('username', $username)->exists()) {
            return redirect()->route('admin.data-perusahaan.create')->with(['status' => 'error', 'message' => 'Username sudah ada.']);
        }

        $user = User::create([
            'username' => $username,
            'password' => Hash::make($request->input('password')),
            'role' => 'Perusahaan',
        ]);

        Perusahaan::create([
            'username' => $user->username,
            'nama' => $request->input('nama'),
            'bidang_usaha' => $request->input('bidang-usaha'),
            'no_telepon' => $request->input('no-telepon'),
            'alamat' => $request->input('alamat'),
            'nama_file_logo' => $request->input('logo'),
        ]);
        return redirect()->route('admin.data-perusahaan.create')->with(['status' => 'success', 'message' => 'Data berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perusahaan $perusahaan)
    {
        $alamat = $this->wilayahController->alamat($perusahaan->alamat);
        $provinsi = $this->wilayahController->provinsi();
        return view('data-perusahaan.edit', compact('perusahaan', 'alamat', 'provinsi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        if ($request->input('status')) {
            $perusahaan->update($request->all());
            if ($perusahaan->status == 'Tidak Aktif') {
                Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)->update(['status' => 'Tidak Dipublikasi']);
            }
            return redirect()->back()->with(['status' => 'success', 'message' => "Status perusahaan berhasil diubah menjadi {$request->input('status')}"]);
        }

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perusahaan $perusahaan)
    {
        //
    }
}
