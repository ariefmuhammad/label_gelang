<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderResep;
use App\Farmasi;
use App\Barang;
use App\Pasien;
use App\Pendaftaran;
use App\TujuanPasien;
use App\Kunjungan;
use App\RincianTagihan;
use App\Ruang;
use App\Pegawai;
use App\Dokter;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{

    public function OrderResep(Request $request) {


        $input = $request->cari;

        // $kunjungan = Kunjungan::where('NOMOR', '1011201012406200201')->where('RUANGAN', 101120101)->first();
        $kunjungan = Kunjungan::where('NOMOR', 'like', '%' . $input . '%')->where('RUANGAN', 101120101)->first();

        if (!$kunjungan) {
            $joins = null;
        }

        $pendaftaran = Pendaftaran::where('NOMOR', $kunjungan['NOPEN'])->first();

        if (!$pendaftaran) {
            $joins = null;
        }

        // $pasien = Pasien::where('NORM', 'like', '%' . $input . '%')->first();
        $pasien = Pasien::where('NORM', $pendaftaran['NORM'])->first();

        if (!$pasien) {
            $joins = null;
        }

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
     
        // $pendaftaran = Pendaftaran::where('NORM', $pasien['NORM'])->orderBy('TANGGAL', 'desc')->first();

        // if (!$pendaftaran) {
        //     $joins = null;
        // }
    
        // $kunjungan = Kunjungan::where('NOPEN', $pendaftaran['NOMOR'])->where('RUANGAN', 101120101)->orderBy('MASUK', 'desc')->first();

        // if (!$kunjungan) {
        //     $joins = null;
        // }

        $resep = OrderResep::where('NOMOR', $kunjungan['REF'])->first();

        if (!$resep) {
            $joins = null;
        }

        $farmasi = Farmasi::where('KUNJUNGAN', $kunjungan['NOMOR'])->first();

        if (!$farmasi) {
            $joins = null;
        }

        $pembayaran = RincianTagihan::where('TAGIHAN', $pendaftaran['NOMOR'])->where('JENIS', '4')->first();
        
        if (!$pembayaran) {
            $joins = null;
        }

        else {

        $ruangan = Ruang::join('pendaftaran.kunjungan', 'master.ruangan.ID', '=', 'pendaftaran.kunjungan.RUANGAN')
        ->select('master.ruangan.*')
        ->where('pendaftaran.kunjungan.NOPEN', $pendaftaran['NOMOR'])
        ->first();


        $dokter = Pegawai::join('master.dokter', 'master.pegawai.NIP', '=', 'master.dokter.NIP')
        ->select('master.pegawai.*', 'master.dokter.NIP', 'master.dokter.ID')
        ->where('master.pegawai.PROFESI', '4')
        ->where('master.pegawai.STATUS', 1)
        ->where('master.dokter.STATUS', 1)
        ->where('master.dokter.ID', $resep['DOKTER_DPJP'])
        ->get();

        foreach ($dokter as $dokters) {
            $dokters['NAMA_GELAR'] = $dokters['GELAR_DEPAN'].". ".$dokters['NAMA'].", ".$dokters['GELAR_BELAKANG'];
        }    

        $join = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS')
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        ->get();

        foreach ($join as $joins) {
            if ($joins['HARI'] == 30) {
                $joins['NORM'] = $pasien['NORM'];
                $joins['RM'] = $pasien['RM'];
                $joins['TANGGAL_LAHIR'] = $pasien['TANGGAL_LAHIR'];
                $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
                $joins['NAMA_PASIEN'] = $pasien['NAMA'];
                $joins['UNIT'] = $ruangan['DESKRIPSI'];
                $joins['DPJP'] = $dokters['NAMA_GELAR'];
                $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
                $joins['KLAIM_KRONIS'] = 23/30 * $pembayaran['TARIF'];
                $joins['KLAIM_INACBG'] = 7/30 *  $pembayaran['TARIF'];
                $joins['QTY'] = $pembayaran['JUMLAH'];
                $joins['KUNJUNGAN'];
                $joins['MASUK'] = $kunjungan['MASUK'];
                $joins['KETERANGAN'] = 'DIBAGI DUA 23 & 7 hari';
            } else {
                $joins['NORM'] = $pasien['NORM'];
                $joins['RM'] = $pasien['RM'];
                $joins['TANGGAL_LAHIR'] = $pasien['TANGGAL_LAHIR'];
                $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
                $joins['NAMA_PASIEN'] = $pasien['NAMA'];
                $joins['UNIT'] = $ruangan['DESKRIPSI'];
                $joins['DPJP'] = $dokters['NAMA_GELAR'];
                $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
                $joins['QTY'] = $pembayaran['JUMLAH'];
                $joins['KUNJUNGAN'];
                $joins['MASUK'] = $kunjungan['MASUK'];
                $joins['KETERANGAN'] = 'TIDAK DIBAGI DUA';
            }
    
         }

        }

        

         $hasilpasien = $joins;

        return response()->json([
            'cari' => $hasilpasien
		]);

    }


    public function OrderResepV(Request $request) {


        $input = $request->cari;
        $pasien = Pasien::where('NORM', 'like', '%' . $input . '%')->first();
        // $pasien = Pasien::where('NORM', 93679)->first();
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
     
        $pendaftaran = Pendaftaran::where('NORM', $pasien['NORM'])->orderBy('TANGGAL', 'desc')->first();

        if (!$pendaftaran) {
            $joins = null;
        }
    
        $kunjungan = Kunjungan::where('NOPEN', $pendaftaran['NOMOR'])->where('RUANGAN', 101120101)->orderBy('MASUK', 'desc')->first();

        if (!$kunjungan) {
            $joins = null;
        }

        $resep = OrderResep::where('NOMOR', $kunjungan['REF'])->first();

        if (!$resep) {
            $joins = null;
        }

        $farmasi = Farmasi::where('KUNJUNGAN', $kunjungan['NOMOR'])->first();

        if (!$farmasi) {
            $joins = null;
        }

        $pembayaran = RincianTagihan::where('TAGIHAN', $pendaftaran['NOMOR'])->where('JENIS', '4')->first();
        
        if (!$pembayaran) {
            $joins = null;
        }

        else {

        $ruangan = Ruang::join('pendaftaran.kunjungan', 'master.ruangan.ID', '=', 'pendaftaran.kunjungan.RUANGAN')
        ->select('master.ruangan.*')
        ->where('pendaftaran.kunjungan.NOPEN', $pendaftaran['NOMOR'])
        ->first();


        $dokter = Pegawai::join('master.dokter', 'master.pegawai.NIP', '=', 'master.dokter.NIP')
        ->select('master.pegawai.*', 'master.dokter.NIP', 'master.dokter.ID')
        ->where('master.pegawai.PROFESI', '4')
        ->where('master.pegawai.STATUS', 1)
        ->where('master.dokter.STATUS', 1)
        ->where('master.dokter.ID', $resep['DOKTER_DPJP'])
        ->get();

        foreach ($dokter as $dokters) {
            $dokters['NAMA_GELAR'] = $dokters['GELAR_DEPAN'].". ".$dokters['NAMA'].", ".$dokters['GELAR_BELAKANG'];
        }    

        $join = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS')
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        ->get();

        foreach ($join as $joins) {
            if ($joins['HARI'] == 30) {
                $joins['NORM'] = $pasien['NORM'];
                $joins['RM'] = $pasien['RM'];
                $joins['TANGGAL_LAHIR'] = $pasien['TANGGAL_LAHIR'];
                $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
                $joins['NAMA_PASIEN'] = $pasien['NAMA'];
                $joins['UNIT'] = $ruangan['DESKRIPSI'];
                $joins['DPJP'] = $dokters['NAMA_GELAR'];
                $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
                $joins['KLAIM_KRONIS'] = 23/30 * $pembayaran['TARIF'];
                $joins['KLAIM_INACBG'] = 7/30 *  $pembayaran['TARIF'];
                $joins['QTY'] = $pembayaran['JUMLAH'];
                $joins['KUNJUNGAN'];
                $joins['MASUK'] = $kunjungan['MASUK'];
                $joins['KETERANGAN'] = 'DIBAGI DUA 23 & 7 hari';
            } else {
                $joins['NORM'] = $pasien['NORM'];
                $joins['RM'] = $pasien['RM'];
                $joins['TANGGAL_LAHIR'] = $pasien['TANGGAL_LAHIR'];
                $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
                $joins['NAMA_PASIEN'] = $pasien['NAMA'];
                $joins['UNIT'] = $ruangan['DESKRIPSI'];
                $joins['DPJP'] = $dokters['NAMA_GELAR'];
                $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
                $joins['QTY'] = $pembayaran['JUMLAH'];
                $joins['KUNJUNGAN'];
                $joins['MASUK'] = $kunjungan['MASUK'];
                $joins['KETERANGAN'] = 'TIDAK DIBAGI DUA';
            }
    
         }

        }

        

         $hasilpasien = $joins;

        return response()->json([
            'cari' => $hasilpasien
		]);

    }

    public function OrderResep2(Request $request) {


        //layanan mysql3
        // $resep = OrderResep::where('STATUS', '2')->select('KUNJUNGAN')->orderBy('TANGGAL', 'desc')->get();

        //layanan mysql3
        // $farmasi = Farmasi::where('STATUS', '2')->select('FARMASI')->orderBy('TANGGAL', 'desc')->get();

        //inventory mysql4
        // $barang = Barang::where('STATUS', '1')->select('NAMA')->orderBy('NAMA', 'asc')->get();
        $input = $request->cari;
        $pasien = Pasien::where('NORM', 'like', '%' . $input . '%')->first();
        // $pasien = Pasien::where('NORM', 93690)->first();
        $pendaftaran = Pendaftaran::where('NORM', $pasien['NORM'])->first();
        $kunjungan = Kunjungan::where('NOPEN', $pendaftaran['NOMOR'])->where('RUANGAN', 101120101)->first();
        $resep = OrderResep::where('NOMOR', $kunjungan['REF'])->first();
        $farmasi = Farmasi::where('KUNJUNGAN', $kunjungan['NOMOR'])->first();
        $pembayaran = RincianTagihan::where('TAGIHAN', $pendaftaran['NOMOR'])->where('JENIS', '4')->first();
       
        $ruangan = Ruang::join('pendaftaran.kunjungan', 'master.ruangan.ID', '=', 'pendaftaran.kunjungan.RUANGAN')
        ->select('master.ruangan.*')
        ->where('pendaftaran.kunjungan.NOPEN', $pendaftaran['NOMOR'])
        ->first();
        
        $join = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGALphp', 'layanan.farmasi.STATUS')
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $kunjungan['NOMOR'])
        ->get();

        foreach ($join as $joins) {
        if ($joins['HARI'] == 1) {
            $joins['NORM'] = $pasien['NORM'];
            $joins['TANGGAL_LAHIR'] = $pasien['TANGGAL_LAHIR'];
            $joins['NAMA_PASIEN'] = $pasien['NAMA'];
            $joins['UNIT'] = $ruangan['DESKRIPSI'];
            $joins['TARIF AWAL'] = $pembayaran['TARIF'];
            $joins['KETERANGAN'] = 'dipotong dua 23 dan 7 hari';
            $joins['KLAIM KRONIS'] = 23/30 * $pembayaran['TARIF'];
            $joins['KLAIM INACBG'] = 7/30 *  $pembayaran['TARIF'];
            $joins['QTY'] = $pembayaran['JUMLAH'];
        } else {
            $joins['KETERANGAN'] = 'tetap dengan total ini';
            $joins['TARIFNYA'] = $pembayaran['TARIF'];
        }

     }




        $data=DB::select('select inventory.barang.NAMA, layanan.farmasi.FARMASI
        from inventory.barang join layanan.farmasi on inventory.barang.ID = layanan.farmasi.FARMASI');

        return response()->json([
            'cari' => $pasien
		]);

    }

    
}
