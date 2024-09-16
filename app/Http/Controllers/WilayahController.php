<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function provinsi () {
        $url = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
        return $url->json();
    }

    public function kota ($provinsiId) {
        $url = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/$provinsiId.json");
        return $url->json();
    }

    public function kecamatan ($kotaId) {
        $url = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/$kotaId.json");
        return $url->json();
    }

    public function kelurahan ($kecamatanId) {
        $url = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/$kecamatanId.json");
        return $url->json();
    }

    public function namaProvinsi ($provinsiId) {
        $url = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
        $provinsiData = $url->json();
        $provinsiCari = collect($provinsiData)->firstWhere('id', $provinsiId);
        $provinsi = ucwords(strtolower($provinsiCari['name']));
        return $provinsi;
    }

    public function namaKota ($provinsiId, $kotaId) {
        $url = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/$provinsiId.json");
        $kotaData = $url->json();
        $kotaCari = collect($kotaData)->firstWhere('id', $kotaId);
        $kota = ucwords(strtolower($kotaCari['name']));
        return $kota;
    }

    public function namaKecamatan ($kotaId, $kecamatanId) {
        $url = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/$kotaId.json");
        $kecamatanData = $url->json();
        $kecamatanCari = collect($kecamatanData)->firstWhere('id', $kecamatanId);
        $kecamatan = ucwords(strtolower($kecamatanCari['name']));
        return $kecamatan;
    }

    public function namaKelurahan ($kecamatanId, $kelurahanId) {
        $url = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/$kecamatanId.json");
        $kelurahanData = $url->json();
        $kelurahanCari = collect($kelurahanData)->firstWhere('id', $kelurahanId);
        $kelurahan = ucwords(strtolower($kelurahanCari['name']));
        return $kelurahan;
    }

    public function alamatLengkap ($request) {
        $kelurahan = $this->namaKelurahan($request->input('kecamatan'), $request->input('kelurahan'));
        $kecamatan = $this->namaKecamatan($request->input('kota'), $request->input('kecamatan'));
        $kota = $this->namaKota($request->input('provinsi'), $request->input('kota'));
        $provinsi = $this->namaProvinsi($request->input('provinsi'));
        $alamat = $request->input('alamat-lengkap') . ', ' . $kelurahan . ', ' . $kecamatan . ', ' . $kota . ', ' . $provinsi;
        return $alamat;
    }

    public function alamat ($alamatData) {
        $alamatArray = explode(', ', $alamatData);
        $alamat = [
            'alamat-lengkap' => $alamatArray[0],
            'kelurahan' => $alamatArray[1],
            'kecamatan' => $alamatArray[2],
            'kota' => $alamatArray[3],
            'provinsi' => $alamatArray[4]
        ];
        return $alamat;
    }
}
