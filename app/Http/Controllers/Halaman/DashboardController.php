<?php

namespace App\Http\Controllers\Halaman;

use Akaunting\Apexcharts\Chart;
use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Kerja;
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
        if (Auth::user()->role == 'Admin BKK') {
            $tahun = $request->input('tahun') ?? Carbon::now()->format('Y');
            $data = $this->admin($tahun);
            return view('dashboard.admin', compact(['tahun', 'data']));
        } elseif (Auth::user()->role == 'Alumni') {
            $data = Loker::where('status', 'Dipublikasi')->paginate(10);
            $data->getCollection()->transform(function ($item) {
                $item->tanggal_akhir = Carbon::parse($item->tanggal_akhir)->format('j M Y H:i');
                return $item;
            });
            return view('lowongan.alumni.index', compact('data'));
        } elseif (Auth::user()->role == 'Perusahaan') {
            $tahun = $request->input('tahun') ?? Carbon::now()->format('Y');
            $data = $this->perusahaan($tahun);
            return view('dashboard.perusahaan', compact(['tahun', 'data']));
        }
    }

    public function admin($tahun)
    {
        // $alumni = Alumni::all();

        // $kerja = 0;
        // $tidakKerja = $alumni->count();

        // foreach ($alumni as $al) {
        //     $jumlahLamaran = Lamaran::where('nik', $al->nik)->where('status', 'Diterima')->count();
        //     $jumlahPengalamanKerja = Kerja::where('nik', $al->nik)->where('tahun_akhir', '<=', $tahun)->count();

        //     if (($jumlahLamaran + $jumlahPengalamanKerja) > 0) {
        //         $kerja++;
        //         $tidakKerja--;
        //     }
        // }

        $bekerja = Alumni::where('status', 'Bekerja')->count();
        $kuliah = Alumni::where('status', 'Kuliah')->count();
        $wirausaha = Alumni::where('status', 'Wirausaha')->count();
        $tidakBekerja = Alumni::where('status', 'Tidak Bekerja')->count();

        $perusahaan = Perusahaan::all();
        $namaPerusahaan = [];
        $jumlahPekerja = [];

        foreach ($perusahaan as $pr) {
            $namaPerusahaan[] = $pr->nama;

            $pekerja = Loker::where('id_data_perusahaan', $pr->id_data_perusahaan)
                ->whereHas('lamaran', function ($query) use ($tahun) {
                    $query->where('status', 'Diterima')->whereYear('waktu', $tahun);
                })->count();

            $jumlahPekerja[] = $pekerja;
        }

        $chart = (new Chart)
            ->setType('bar')
            ->setWidth('100%')
            ->setHeight(400)
            ->setLabels($namaPerusahaan)
            ->setDataset('Jumlah Alumni Yang Bekerja', 'bar', $jumlahPekerja);

        return $data = [
            'bekerja' => $bekerja,
            'kuliah' => $kuliah,
            'wirausaha' => $wirausaha,
            'tidak-bekerja' => $tidakBekerja,
            'chart' => $chart,
        ];
    }

    public function perusahaan($tahun)
    {
        $perusahaan = Perusahaan::find(Auth::user()->id_data_perusahaan);

        $loker = Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)->count();
        $lokerPublikasi = Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)
            ->where('status', 'Dipublikasi')
            ->count();

        $lokerIds = Loker::where('id_data_perusahaan', $perusahaan->id_data_perusahaan)->pluck('id_lowongan_pekerjaan');

        $totalLamaran = Lamaran::where('id_lowongan_pekerjaan', $lokerIds)->count();
        $lamaran = Lamaran::whereIn('status', ['Terkirim'])
            ->whereIn('id_lowongan_pekerjaan', $lokerIds)
            ->count();

        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $jumlahLamaranPerBulan = [];
        foreach (range(1, 12) as $month) {
            $jumlahLamaranPerBulan[] = Lamaran::whereYear('waktu', $tahun)
                ->whereMonth('waktu', $month)
                ->whereIn('id_lowongan_pekerjaan', $lokerIds)
                ->count();
        }

        $chart = (new Chart)
            ->setType('bar')
            ->setWidth('100%')
            ->setHeight(400)
            ->setLabels($bulan)
            ->setDataset('Jumlah Lamaran', 'bar', $jumlahLamaranPerBulan);

        return $data = [
            'loker' => $loker,
            'lokerPublikasi' => $lokerPublikasi,
            'total-lamaran' => $totalLamaran,
            'lamaran' => $lamaran,
            'chart' => $chart,
        ];
    }
}
