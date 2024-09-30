<?php

namespace App\Http\Controllers\Halaman;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DetailAlumniBekerjaExport;
use App\Exports\LacakAlumniExport;
use Maatwebsite\Excel\Excel as ExportType;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['angkatan' => 'integer|digits:4']);
        $kategori = $request->input('kategori') ?? null;
        $periode = $request->input('waktu') ?? Carbon::now()->translatedFormat('j F Y');
        $angkatan = $request->input('angkatan') ?? Carbon::now()->translatedFormat('Y');
        $periodeAwal = $this->periodeAwal($periode);
        $periodeAkhir = $this->periodeAkhir($periode);
        $data = [];
        $data['detail-alumni-bekerja'] = $this->detailALumniBekerja($periodeAwal, $periodeAkhir);

        $data['lacak-alumni'] = [
            'bekerja' => Alumni::where('status', 'Bekerja')->where('tahun_lulus', $angkatan)->count(),
            'kuliah' => Alumni::where('status', 'Kuliah')->where('tahun_lulus', $angkatan)->count(),
            'wirausaha' => Alumni::where('status', 'Wirausaha')->where('tahun_lulus', $angkatan)->count(),
            'tidak bekerja' => Alumni::where('status', 'Tidak Bekerja')->where('tahun_lulus', $angkatan)->count(),
        ];

        if ($request->input('type-file')) {
            $typeFile = $request->input('type-file');
            $isDetailAlumniBekerja = $request->input('data') === 'detail-alumni-bekerja';
            $namaFile = $isDetailAlumniBekerja ? "detail-alumni-bekerja_periode_{$periode}" : "lacak-alumni_angkatan_{$angkatan}";
            $kategori = $isDetailAlumniBekerja ? 'detail-alumni-bekerja' : 'lacak-alumni';
            $title = $isDetailAlumniBekerja ? 'Laporan Detail Alumni Bekerja' : 'Laporan Lacak Kegiatan Alumni';
            $headers = $isDetailAlumniBekerja ? ['No.', 'NIK', 'NAMA LENGKAP', 'NAMA PERUSAHAAN'] : ['STATUS', 'JUMLAH ALUMNI'];

            if ($typeFile == 'pdf') {
                $pdf = Pdf::loadView('partials.laporan', compact('title', 'periode', 'headers', 'data', 'kategori'));
                return $pdf->download("{$namaFile}.pdf");
            } elseif ($typeFile == 'csv') {
                $exportClass = $isDetailAlumniBekerja ? DetailAlumniBekerjaExport::class : LacakAlumniExport::class;
                return Excel::download(new $exportClass($data[$kategori]), "{$namaFile}.csv", ExportType::CSV);
            } elseif ($typeFile == 'xlsx') {
                $exportClass = $isDetailAlumniBekerja ? DetailAlumniBekerjaExport::class : LacakAlumniExport::class;
                return Excel::download(new $exportClass($data[$kategori]), "{$namaFile}.xlsx", ExportType::XLSX);
            }
        }

        return view('laporan', compact('periode', 'data', 'angkatan', 'kategori'));
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

            $namaPerusahaan = implode(', ', $perusahaan);

            if (!empty($namaPerusahaan)) {
                $data[] = [
                    'nik' => $al->nik,
                    'nama' => $al->nama,
                    'nama-perusahaan' => $namaPerusahaan,
                ];
            }
        }

        return $data;
    }
}
