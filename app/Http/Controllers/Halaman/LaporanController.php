<?php

namespace App\Http\Controllers\Halaman;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DetailAlumniBekerjaExport;
use Maatwebsite\Excel\Excel as ExportType;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->input('waktu') ?? Carbon::now()->translatedFormat('j F Y');
        $periodeAwal = $this->periodeAwal($periode);
        $periodeAkhir = $this->periodeAkhir($periode);
        $data = $this->detailALumniBekerja($periodeAwal, $periodeAkhir);

        $namaFile = $request->input('data') . '_periode_' . $periode;

        if ($request->input('type-file')) {
            if ($request->input('type-file') == 'pdf') {
                $title = 'Laporan Detail Alumni Bekerja';
                $pdf = Pdf::loadView('partials.laporan', ['title' => $title, 'periode' => $periode, 'data' => $data]);
                return $pdf->download("{$namaFile}.pdf");
            } elseif ($request->input('type-file') == 'csv') {
                return Excel::download(new DetailAlumniBekerjaExport($data), "{$namaFile}.csv", ExportType::CSV);
            } elseif ($request->input('type-file') == 'xlsx') {
                return Excel::download(new DetailAlumniBekerjaExport($data), "{$namaFile}.xlsx", ExportType::XLSX);
            }
        }

        return view('laporan', compact('periode', 'data'));
    }

    public function periodeAwal($periode)
    {
        if (strpos($periode, ' sampai ') !== false) {
            [$tanggalAwal, $tanggalAkhir] = explode(' sampai ', $periode);
        } else {
            $tanggalAwal = $tanggalAkhir = $periode;
        }

        return Carbon::createFromFormat('j F Y', $tanggalAwal)->format('Y-m-d');
    }

    public function periodeAkhir($periode)
    {
        if (strpos($periode, ' sampai ') !== false) {
            [$tanggalAwal, $tanggalAkhir] = explode(' sampai ', $periode);
        } else {
            $tanggalAwal = $tanggalAkhir = $periode;
        }

        return Carbon::createFromFormat('j F Y', $tanggalAkhir)->format('Y-m-d');
    }

    public function detailALumniBekerja($periodeAwal, $periodeAkhir)
    {
        $alumni = Alumni::with('lamaran.loker.perusahaan')->get();
        $data = [];

        foreach ($alumni as $al) {
            $perusahaan = [];

            foreach ($al->lamaran as $lamaran) {
                $tanggalLamaran = Carbon::parse($lamaran->waktu)->format('Y-m-d');

                if ($tanggalLamaran >= $periodeAwal && $tanggalLamaran <= $periodeAkhir) {
                    $namaPerusahaan = $lamaran->loker->perusahaan->nama;

                    if (!in_array($namaPerusahaan, $perusahaan)) {
                        $perusahaan[] = $namaPerusahaan;
                    }
                }
            }

            $jabatan = implode(', ', $perusahaan);

            if (!empty($jabatan)) {
                $data[] = [
                    'nik' => $al->nik,
                    'nama' => $al->nama,
                    'jabatan' => $jabatan,
                ];
            }
        }

        return $data;
    }
}
