<?php

namespace App\Http\Controllers\Halaman;

use Akaunting\Apexcharts\Chart;
use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Lamaran;
use App\Models\Loker;
use App\Models\Perusahaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tahun = $request->input('periode') ?? Carbon::now()->format('Y');
        if (Auth::user()->role == 'Admin BKK') {
            $data = $this->admin($tahun);
            return view('dashboard.admin', compact(['tahun', 'data']));
        } elseif (Auth::user()->role == 'Alumni') {
            $bulan = $request->input('periode') ?? Carbon::now()->format('m');
            $data = $this->alumni($bulan);
            return view('dashboard.alumni', compact(['bulan', 'data']));
        } elseif (Auth::user()->role == 'Perusahaan') {
            $data = $this->perusahaan($tahun);
            return view('dashboard.perusahaan', compact(['tahun', 'data']));
        }
    }

    public function admin($tahun)
    {
        $statusCounts = [
            'bekerja' => Alumni::where('status', 'Bekerja')->count(),
            'kuliah' => Alumni::where('status', 'Kuliah')->count(),
            'wirausaha' => Alumni::where('status', 'Wirausaha')->count(),
            'tidak-bekerja' => Alumni::where('status', 'Tidak Bekerja')->count(),
            'ajuan-lowongan' => Loker::where('status', 'Tertunda')->count(),
        ];

        $perusahaanData = Perusahaan::all()->map(function ($pr) use ($tahun) {
            return [
                'nama' => $pr->nama,
                'jumlahPekerja' => Loker::where('id_data_perusahaan', $pr->id_data_perusahaan)
                    ->whereHas('lamaran', fn($q) => $q->where('status', 'Diterima')->whereYear('waktu', $tahun))
                    ->count(),
            ];
        })->sortByDesc('jumlahPekerja')->take(10)->values()->toArray();

        $namaPerusahaanTerbatas = array_column($perusahaanData, 'nama');
        $jumlahPekerjaTerbatas = array_column($perusahaanData, 'jumlahPekerja');

        $chartDetailAlumniBekerja = (new Chart)
            ->setType('bar')
            ->setWidth('100%')
            ->setHeight(400)
            ->setLabels($namaPerusahaanTerbatas)
            ->setDataset('Jumlah Alumni Yang Bekerja', 'bar', $jumlahPekerjaTerbatas);

        $jurusan = ['AK', 'BR', 'DKV', 'MLOG', 'MP', 'RPL', 'TKJ'];
        $status = ['Bekerja', 'Kuliah', 'Wirausaha', 'Tidak Bekerja'];

        $lacakAlumniJurusan = collect($jurusan)->mapWithKeys(function ($jur) use ($status) {
            $lacakAlumni = array_map(fn($s) => Alumni::where('jurusan', $jur)->where('status', $s)->count(), $status);
            return [$jur => (new Chart)
                ->setType('donut')
                ->setWidth('100%')
                ->setHeight(400)
                ->setLabels($status)
                ->setDataset("Jumlah Alumni $jur", 'donut', $lacakAlumni)];
        })->toArray();

        $lacakAlumni = array_map(fn($s) => Alumni::where('status', $s)->count(), $status);
        $chartLacakAlumni = (new Chart)
            ->setType('donut')
            ->setWidth('100%')
            ->setHeight(400)
            ->setLabels($status)
            ->setDataset('Jumlah Alumni', 'donut', $lacakAlumni);

        $chart = [
            'detail-alumni-bekerja' => $chartDetailAlumniBekerja,
            'lacak-alumni' => $chartLacakAlumni,
            'lacak-alumni-jurusan' => $lacakAlumniJurusan,
        ];

        return array_merge($statusCounts, ['chart' => $chart]);
    }

    public function perusahaan($tahun)
    {
        $perusahaan = Perusahaan::find(Auth::user()->id_data_perusahaan);

        $lokerCount = Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)->count();
        $lokerPublikasiCount = Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)
            ->where('status', 'Dipublikasi')->count();

        $lokerIds = Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)
            ->pluck('id_lowongan_pekerjaan')->toArray();

        $totalLamaran = Lamaran::whereIn('id_lowongan_pekerjaan', $lokerIds)->count();
        $lamaranCount = Lamaran::whereIn('status', ['Terkirim'])
            ->whereIn('id_lowongan_pekerjaan', $lokerIds)
            ->count();

        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $jumlahLowonganPerBulan = [];
        $jumlahLamaranPerBulan = [];
        $jabatanLowonganList = [];
        $jumlahLamaranPerLowongan = [];
        $jumlahDiterimaPerLowongan = [];
        foreach (range(1, 12) as $month) {
            $jumlahLowonganPerBulan[] = Loker::whereYear('waktu', $tahun)
                ->whereMonth('waktu', $month)
                ->where('id_data_perusahaan', $perusahaan->id_data_perusahaan)
                ->count();
            $jumlahLamaranPerBulan[] = Lamaran::whereYear('waktu', $tahun)
                ->whereMonth('waktu', $month)
                ->whereIn('id_lowongan_pekerjaan', $lokerIds)
                ->count();
        }

        foreach ($perusahaan->loker as $lowonganPerusahaan) {
            $lowongan = Loker::where('id_lowongan_pekerjaan', $lowonganPerusahaan->id_lowongan_pekerjaan)
                ->whereYear('waktu', $tahun)
                ->first();

            if ($lowongan) {
                if (!in_array($lowongan->jabatan, $jabatanLowonganList)) {
                    $jabatanLowonganList[] = $lowongan->jabatan;
                }

                if (!isset($jumlahLamaranPerLowongan[$lowongan->jabatan])) {
                    $jumlahLamaranPerLowongan[$lowongan->jabatan] = Lamaran::where('id_lowongan_pekerjaan', $lowongan->id_lowongan_pekerjaan)
                        ->whereYear('waktu', $tahun)
                        ->count();
                }
                if (!isset($jumlahDiterimaPerLowongan[$lowongan->jabatan])) {
                    $jumlahDiterimaPerLowongan[$lowongan->jabatan] = Lamaran::where('id_lowongan_pekerjaan', $lowongan->id_lowongan_pekerjaan)
                        ->whereYear('waktu', $tahun)
                        ->where('status', 'Diterima')
                        ->count();
                }
            }
        }

        $chartLamaranLowongan = (new Chart)
            ->setType('bar')
            ->setWidth('100%')
            ->setHeight(400)
            ->setLabels($jabatanLowonganList)
            ->setDataset('Jumlah Lamaran', 'bar', array_values($jumlahLamaranPerLowongan))
            ->setDataset('Jumlah Lamaran Diterima', 'bar', array_values($jumlahDiterimaPerLowongan));

        $chartLowonganBulan = (new Chart)
            ->setType('bar')
            ->setWidth('100%')
            ->setHeight(400)
            ->setLabels($bulan)
            ->setDataset('Jumlah Lowongan', 'bar', $jumlahLowonganPerBulan)
            ->setDataset('Jumlah Lamaran', 'bar', $jumlahLamaranPerBulan);

        $chart = [
            'lamaran' => $chartLamaranLowongan,
            'lowongan-lamaran' => $chartLowonganBulan,
        ];

        return [
            'loker' => $lokerCount,
            'lokerPublikasi' => $lokerPublikasiCount,
            'total-lamaran' => $totalLamaran,
            'lamaran' => $lamaranCount,
            'chart' => $chart,
        ];
    }

    public function alumni($month)
    {
        $alumni = Alumni::find(Auth::user()->alumni->nik);
        $jabatanLowonganList = [];
        $jumlahDiterimaPerLowongan = [];

        if ($alumni && $alumni->lamaran) {
            foreach ($alumni->lamaran as $lamaran) {
                foreach ($lamaran->loker->perusahaan->loker as $lowonganPerusahaan) {
                    $lowongan = Loker::where('id_lowongan_pekerjaan', $lowonganPerusahaan->id_lowongan_pekerjaan)
                        ->whereYear('waktu', Carbon::now())
                        ->whereMonth('waktu', $month)
                        ->where('status', 'Dipublikasi')
                        ->first();

                    if ($lowongan) {
                        if (!in_array($lowongan->jabatan, $jabatanLowonganList)) {
                            $jabatanLowonganList[] = $lowongan->jabatan;
                        }

                        if (!isset($jumlahDiterimaPerLowongan[$lowongan->jabatan])) {
                            $jumlahDiterimaPerLowongan[$lowongan->jabatan] = Lamaran::where('id_lowongan_pekerjaan', $lowongan->id_lowongan_pekerjaan)
                                ->whereYear('waktu', Carbon::now())
                                ->whereMonth('waktu', $month)
                                ->where('status', 'Diterima')
                                ->count();
                        }
                    }
                }
            }
        }

        $chart = (new Chart)
            ->setType('bar')
            ->setWidth('100%')
            ->setHeight(400)
            ->setLabels($jabatanLowonganList)
            ->setDataset('Jumlah Lamaran Diterima', 'bar', array_values($jumlahDiterimaPerLowongan));

        return [
            'chart' => $chart,
        ];
    }
}
