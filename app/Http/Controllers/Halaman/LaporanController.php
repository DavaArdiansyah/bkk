<?php

namespace App\Http\Controllers\Halaman;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DetailAlumniBekerjaExport;
use App\Exports\LacakAlumniExport;
use App\Http\Requests\LaporanRequest;
use Maatwebsite\Excel\Excel as ExportType;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(LaporanRequest $request)
    {
        $kategori = $request->input('kategori') ?? null;
        $periode = $request->input('waktu') ?? Carbon::now()->translatedFormat('j F Y');
        $angkatan = $request->input('angkatan') ?? Carbon::now()->translatedFormat('Y');
        $periodeAwal = $this->periodeAwal($periode);
        $periodeAkhir = $this->periodeAkhir($periode);
        $data['detail-alumni-bekerja'] = $this->detailALumniBekerja($periodeAwal, $periodeAkhir);

        $jurusan = ['AK', 'BR', 'DKV', 'MLOG', 'MP', 'RPL', 'TKJ'];
        $status = ['Bekerja', 'Kuliah', 'Wirausaha', 'Tidak Bekerja'];

        foreach ($status as $s) {
            $data['lacak-alumni'][$s] = [
                'Semua' => Alumni::where('status', $s)->where('tahun_lulus', $angkatan)->count()
            ];

            foreach ($jurusan as $j) {
                $data['lacak-alumni'][$s][$j] = Alumni::where('status', $s)->where('tahun_lulus', $angkatan)->where('jurusan', $j)->count();
            }
        }


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
        $alumni = Alumni::all();
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
