<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Triage;
use App\Pendaftaran;
use App\Kunjungan;
use App\Pasien;
use App\Ruang;
use App\Dokter;
use App\Pegawai;

class TriageController extends Controller
{
    public function Triage(Request $request){

        $input = $request->cari;

        // $pendaftaran = Pendaftaran::where('NOMOR', '2406300077')->first();
        $pendaftaran = Pendaftaran::where('NOMOR', 'like', '%' . $input . '%')->first();

        if (!$pendaftaran) {
            $joins = null;
        }

        $kunjungan = Kunjungan::where('NOPEN', $pendaftaran['NOMOR'])->where('RUANGAN', 101020101)->first();

        if (!$kunjungan) {
            $joins = null;
        }

        $pasien = Pasien::where('NORM', $pendaftaran['NORM'])->first();

        if (!$pasien) {
            $joins = null;
        }

        else {

        $norm = $pasien['NORM'];
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }

        $parts = str_split($norm, $split_length = 2);

        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $lahir = date("d/m/Y", strtotime($pasien['TANGGAL_LAHIR']));
        $nama = $pasien['NAMA'];

        $pasien['RM'] = $norm;
        $pasien['TANGGAL_LAHIR'] = $lahir;

       

        $ruangan = Ruang::join('pendaftaran.kunjungan', 'master.ruangan.ID', '=', 'pendaftaran.kunjungan.RUANGAN')
        ->select('master.ruangan.*')
        ->where('pendaftaran.kunjungan.NOPEN', $pendaftaran['NOMOR'])
        ->first();

        $dokter = Pegawai::join('master.dokter', 'master.pegawai.NIP', '=', 'master.dokter.NIP')
        ->select('master.pegawai.*', 'master.dokter.NIP', 'master.dokter.ID')
        ->where('master.pegawai.PROFESI', '4')
        ->where('master.pegawai.STATUS', 1)
        ->where('master.dokter.STATUS', 1)
        ->where('master.dokter.ID', $kunjungan['DPJP'])
        ->get();

        foreach ($dokter as $dokters) {
            $dokters['NAMA_GELAR'] = $dokters['GELAR_DEPAN'].". ".$dokters['NAMA'].", ".$dokters['GELAR_BELAKANG'];
        }  


        $triage = Triage::where('NOPEN', $pendaftaran['NOMOR'])->get();


        foreach($triage as $triages) {
            $triages['NOPEN'];
            $triages['NORM'];
            $triages['TANGGAL'];
            $triages['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
            $triages['RM'] = $pasien['RM'];
            $triages['NAMA_PASIEN'] = $pasien['NAMA'];
            $triages['UNIT'] = $ruangan['DESKRIPSI'];
            $triages['DPJP'] = $dokters['NAMA_GELAR'];
            $triages['TANGGAL_LAHIR'] = $pasien['TANGGAL_LAHIR'];
        }
    }

        $data = $triages;

        return response()->json([
            'cari' => $data
		]);

    }
}
