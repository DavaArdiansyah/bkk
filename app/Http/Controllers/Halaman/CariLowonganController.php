<?php

namespace App\Http\Controllers\Halaman;

use App\Http\Controllers\Controller;
use App\Models\Loker;
use App\Models\Perusahaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CariLowonganController extends Controller
{
    public function data($request)
    {
        $perusahaan = Perusahaan::where('nama', 'LIKE', '%' . $request . '%')->get();

        $perusahaanId = $perusahaan->pluck('id_data_perusahaan')->toArray();

        $lokerBySearch = Loker::where(function ($query) use ($request) {
            $query->where('jabatan', 'LIKE', '%' . $request . '%')
                ->orWhere('jenis_waktu_pekerjaan', 'LIKE', '%' . $request . '%');
        })
            ->where('status', 'Dipublikasi')
            ->paginate(10);

        if ($perusahaanId) {
            $lokerBySearch = Loker::where('id_data_perusahaan', $perusahaanId)->where('status', 'Dipublikasi')->paginate(10);
        }
        $lokerBySearch->getCollection()->transform(function ($item) {
            $item->tanggal_akhir = Carbon::parse($item->tanggal_akhir)->format('j M Y H:i');
            return $item;
        });
        return $lokerBySearch;
    }

    public function index(Request $request)
    {
        if ($request->input('kata-kunci')) {
            $data = $this->data($request->input('kata-kunci'));
            return view('lowongan.alumni.index', [
                'data' => $data,
                'kataKunci' => $request->input('kata-kunci'),
            ]);
        }
        return redirect()->route('dashboard');
    }

    public function show(Loker $loker)
    {
        $loker->tanggal_akhir = Carbon::parse($loker->tanggal_akhir)->format('j M Y H:i');
        return view('lowongan.alumni.show', compact('loker'));
    }
}
