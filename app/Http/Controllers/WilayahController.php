<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    protected $client;
    protected $baseApiUrl = 'https://emsifa.github.io/api-wilayah-indonesia/api/';

    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client();
    }

    private function fetchData($endpoint)
    {
        $response = $this->client->get($this->baseApiUrl . $endpoint);
        return json_decode($response->getBody()->getContents(), true);
    }

    private function getWilayahName($data, $id)
    {
        $wilayah = collect($data)->firstWhere('id', $id);
        return $wilayah ? ucwords(strtolower($wilayah['name'])) : null;
    }

    public function provinsi()
    {
        return $this->fetchData('provinces.json');
    }

    public function kota($provinsiId)
    {
        return $this->fetchData("regencies/$provinsiId.json");
    }

    public function kecamatan($kotaId)
    {
        return $this->fetchData("districts/$kotaId.json");
    }

    public function kelurahan($kecamatanId)
    {
        return $this->fetchData("villages/$kecamatanId.json");
    }

    public function namaProvinsi($provinsiId)
    {
        $provinsiData = $this->provinsi();
        return $this->getWilayahName($provinsiData, $provinsiId);
    }

    public function namaKota($provinsiId, $kotaId)
    {
        $kotaData = $this->kota($provinsiId);
        return $this->getWilayahName($kotaData, $kotaId);
    }

    public function namaKecamatan($kotaId, $kecamatanId)
    {
        $kecamatanData = $this->kecamatan($kotaId);
        return $this->getWilayahName($kecamatanData, $kecamatanId);
    }

    public function namaKelurahan($kecamatanId, $kelurahanId)
    {
        $kelurahanData = $this->kelurahan($kecamatanId);
        return $this->getWilayahName($kelurahanData, $kelurahanId);
    }

    public function alamatLengkap(Request $request)
    {
        $kelurahan = $this->namaKelurahan($request->input('kecamatan'), $request->input('kelurahan'));
        $kecamatan = $this->namaKecamatan($request->input('kota'), $request->input('kecamatan'));
        $kota = $this->namaKota($request->input('provinsi'), $request->input('kota'));
        $provinsi = $this->namaProvinsi($request->input('provinsi'));

        $alamatLengkap = $request->input('alamat-lengkap');
        return implode(', ', array_filter([$alamatLengkap, $kelurahan, $kecamatan, $kota, $provinsi]));
    }

    public function alamat($alamatData)
    {
        $alamatArray = explode(', ', $alamatData);

        return [
            'alamat-lengkap' => $alamatArray[0] ?? '',
            'kelurahan' => $alamatArray[1] ?? '',
            'kecamatan' => $alamatArray[2] ?? '',
            'kota' => $alamatArray[3] ?? '',
            'provinsi' => $alamatArray[4] ?? ''
        ];
    }
}
