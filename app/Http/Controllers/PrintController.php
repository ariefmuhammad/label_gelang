<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use App\Tujuan;
use App\Pendaftaran;
use App\Ruang;
use PDF;
use Carbon\Carbon;
use App\DokterRuangan;
use App\Dokter;
use App\Pegawai;
///
use App\OrderResep;
use App\Farmasi;
use App\Barang;
use App\Pasien;
use App\TujuanPasien;
use App\Kunjungan;
use App\RincianTagihan;
use App\Tagihan;
///
use App\Triage;

class PrintController extends Controller
{
     // Template
     public function templateLabel($id, $awalan, $tgl_masuk)

     {
         // dd($awalan);

        $label = Data::where('NORM',  $id)->get();
        $norm = $label[0]->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }

        $parts = str_split($norm, $split_length = 2);

        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));

        $label[0]['NORM'] = $norm;
        $label[0]['TANGGAL_LAHIR'] = $lahir;
        $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
        $data['label'] = $label;

        // // $count = count($label);
        // // $data['count'] = $count;
        $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
        $data['TANGGAL_MASUK'] = $tanggal_masuk;


        $pdf = PDF::loadView('print.label', $data)->setPaper([0,0,80.732,170.079], 'landscape');
        return $pdf->stream();

        // return view('print.label', $data);
        // return $pdf->download('laporan-pdf.pdf')
     }

     public function templateGelangDewasa($id, $awalan, $tgl_masuk)

     {
         // dd($awalan);

         $label = Data::where('NORM',  $id)->get();
         $norm = $label[0]->NORM;
         $length = strlen($norm);
         for ($i=$length; $i < 6; $i++) {
                 $norm = "0" . $norm;
         }

         $parts = str_split($norm, $split_length = 2);

         $norm = $parts[0].".".$parts[1].".".$parts[2];
         $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));

         $label[0]['NORM'] = $norm;
         $label[0]['TANGGAL_LAHIR'] = $lahir;
         $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
         $data['label'] = $label;

         // // $count = count($label);
         // // $data['count'] = $count;
         $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
         $data['TANGGAL_MASUK'] = $tanggal_masuk;

        $pdf = PDF::loadView('print.gelangdewasa', $data)->setPaper([0, 0, 70.98, 700.85], 'landscape');
        return $pdf->stream();

        // return view('print.gelangdewasa', compact('label'));
        // return $pdf->download('laporan-pdf.pdf')
     }

     public function templateGelangAnak($id, $awalan, $tgl_masuk)

     {

         // dd($awalan);

         $label = Data::where('NORM',  $id)->get();
         $norm = $label[0]->NORM;
         $length = strlen($norm);
         for ($i=$length; $i < 6; $i++) {
                 $norm = "0" . $norm;
         }

         $parts = str_split($norm, $split_length = 2);

         $norm = $parts[0].".".$parts[1].".".$parts[2];
         $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));

         $label[0]['NORM'] = $norm;
         $label[0]['TANGGAL_LAHIR'] = $lahir;
         $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
         $data['label'] = $label;

         // // $count = count($label);
         // // $data['count'] = $count;
         $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
         $data['TANGGAL_MASUK'] = $tanggal_masuk;

         $pdf = PDF::loadView('print.gelanganak', $data)->setPaper([0, 0, 70.98, 600.85], 'landscape');
         return $pdf->stream();

        //  return view('print.gelanganak');
        // return $pdf->download('laporan-pdf.pdf');
     }

//      public function templateTracer()

//      {
//          $tracer = Data::first();
//          $data['tracer'] = $tracer;
//          // $count = count($label);
//          // $data['count'] = $count;
//          $data['today'] = date('d/m/Y');

//          $pdf = PDF::loadView('print.tracer', $data);
//          // return $pdf->stream();
//          return view('print.tracer',$data);
//          // return $pdf->download('laporan-pdf.pdf');
//         //  adad
//      }


     public function templateTracer($id, $awalan, $tgl_masuk, $peminjam)

     {
         // dd($awalan);

         $label = Data::where('NORM',  $id)->get();
         $norm = $label[0]->NORM;
         $length = strlen($norm);
         for ($i=$length; $i < 6; $i++) {
                 $norm = "0" . $norm;
         }

         $parts = str_split($norm, $split_length = 2);

         $norm = $parts[0].".".$parts[1].".".$parts[2];
         $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));

         $label[0]['NORM'] = $norm;
         $label[0]['TANGGAL_LAHIR'] = $lahir;
         $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
         $data['label'] = $label;

         // // $count = count($label);
         // // $data['count'] = $count;
         $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
         $data['TANGGAL_MASUK'] = $tanggal_masuk;

         $peminjam = $peminjam;
         $data['PEMINJAM'] = $peminjam;

         $data["pendaftaran"] = Pendaftaran::where('NORM', $id)->whereDate('TANGGAL',$tgl_masuk)->first();
         if ($data["pendaftaran"]) {
            $data["tujuan"] = Tujuan::where('NOPEN',$data["pendaftaran"]->NOMOR)->first();
            $data["poli"] = Ruang::where('ID',$data["tujuan"]->RUANGAN)->first();
            $data["poli"] = $data["poli"]["DESKRIPSI"];
         }
         else {
            $data["poli"] = "";
         }


        //  dd($peminjam);


         $pdf = PDF::loadView('print.tracer', $data)->setPaper([0,0,80.732,170.079], 'landscape');
         return $pdf->stream();

         // return view('print.label', $data);
         // return $pdf->download('laporan-pdf.pdf')
     }

     public function templateTracerV2($id, $awalan, $tgl_masuk, $peminjam, $no_urut)

     {
         // dd($awalan);

         $label = Data::where('NORM',  $id)->get();
         $norm = $label[0]->NORM;
         $length = strlen($norm);
         for ($i=$length; $i < 6; $i++) {
                 $norm = "0" . $norm;
         }

         $parts = str_split($norm, $split_length = 2);

         $norm = $parts[0].".".$parts[1].".".$parts[2];
         $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));

         $label[0]['NORM'] = $norm;
         $label[0]['TANGGAL_LAHIR'] = $lahir;
         $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];

         $label[0]['noUrut'] = $no_urut;
         $data['label'] = $label;

         // // $count = count($label);
         // // $data['count'] = $count;
         $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
         $data['TANGGAL_MASUK'] = $tanggal_masuk;

         $peminjam = $peminjam;
         $data['PEMINJAM'] = $peminjam;

         

         $data["pendaftaran"] = Pendaftaran::where('NORM', $id)->whereDate('TANGGAL', Carbon::now()->today())->first();
         if ($data["pendaftaran"]) {
         $data["tujuan_pasien"] = Tujuan::where('NOPEN',$data["pendaftaran"]->NOMOR)->first();
         $data["ruangan"] = Ruang::where('ID',$data["tujuan_pasien"]->RUANGAN)->first();
         $data["poli"] = $data["ruangan"]["DESKRIPSI"];
         $data["dokter_ruangan"] = DokterRuangan::where('RUANGAN',$data["ruangan"]->ID)->where('DOKTER',$data["tujuan_pasien"]->DOKTER)->first();
         $data['dokter'] = Dokter::where('ID',$data["tujuan_pasien"]->DOKTER)->first();
         $data['pegawai'] = Pegawai::where('NIP', $data['dokter']->NIP)->first();
         $data['nama_dokter'] = $data['pegawai']->GELAR_DEPAN.'. '.$data['pegawai']->NAMA.'. '.$data['pegawai']->GELAR_BELAKANG;
       
        
         
         $dokter_ruangan = DokterRuangan::where('RUANGAN',$data["ruangan"]->ID)->where('DOKTER',$data["tujuan_pasien"]->DOKTER)->get();
         
         foreach ($dokter_ruangan as $dokter_ruangans) {
            $cek = Dokter::where('ID',$dokter_ruangans['DOKTER'])->first();
            if ($cek['STATUS'] === 1) {
                $dokter[] = Dokter::where('ID',$dokter_ruangans['DOKTER'])->first();
            }
         }

         


         $dokterCount = 0;  
         foreach ($dokter as $dokters) {
            $today = $pendaftarans = Pendaftaran::whereDate('TANGGAL', Carbon::now()->today())->orderBy("TANGGAL", "DESC")->get();
            foreach ($today as $todays) {
            $DD = Tujuan::where('DOKTER',$dokters['ID'])->where('NOPEN',$todays['NOMOR'])->first();
            if ($DD) {
                $tujuan_dokter[$dokterCount][] = $DD;
            }
           }
         }
        
         
         $namaa = Pegawai::where('NIP',$dokters['NIP'])->first();
            if(empty($tujuan_dokter[$dokterCount][0])) {
                $nameng['nama_dokter'] = $namaa->GELAR_DEPAN.'. '.$namaa->NAMA.', '.$namaa->GELAR_BELAKANG;
                $nameng['NORM'] = "";
                $nameng['NAMA'] = "";
                $nameng['JENIS_KELAMIN'] = "";
                $nameng['TANGGAL_LAHIR'] = "";
                $nameng['nomor'] = "";
                $tujuan_dokter[$dokterCount][] = $nameng;
            }
            
         else {
            $offset = count($tujuan_dokter[$dokterCount]);
            foreach ($tujuan_dokter[$dokterCount] as $namaDokter) {
                $namaDokter['nama_dokter'] = $namaa->GELAR_DEPAN.'. '.$namaa->NAMA.', '.$namaa->GELAR_BELAKANG;
                $pendaftarans = Pendaftaran::whereDate('TANGGAL', Carbon::now()->today())->where('NOMOR', $namaDokter['NOPEN'])->first();    
                if (!$pendaftarans) {        
                    $namaDokter['NORM'] = "";
                    $namaDokter['NAMA'] = "";
                    $namaDokter['JENIS_KELAMIN'] = "";
                    $namaDokter['TANGGAL_LAHIR'] = "";
                } else {
                    $pasen = Data::where('NORM', $pendaftarans['NORM'])->first();

                    $normtitik = $pasen['NORM'];
                    $length = strlen($normtitik);
                    for ($i=$length; $i < 6; $i++) {
                            $normtitik = "0" . $normtitik;
                    }
                    $parts = str_split($normtitik, $split_length = 2);
                    $normtitik = $parts[0].".".$parts[1].".".$parts[2];

                    $namaDokter['NORM'] = $pasen['NORM'];
                    $namaDokter['NORMTITIK'] = $normtitik;
                    $namaDokter['NAMA'] = $pasen['NAMA'];
                    $namaDokter['JENIS_KELAMIN'] = $pasen['JENIS_KELAMIN'];
                    $namaDokter['TANGGAL_LAHIR'] = date("d/m/Y", strtotime($pasen['TANGGAL_LAHIR']));
                    $namaDokter['nomor'] = $offset;
                    $offset--;
                    



                    //  $no_urut = $namaDokter['nomor'] = $offset;
                    //  $data['no_urut'] = $no_urut;                    
                    // if ($pasen['NORM'] === $label[0]['NORM']) {
                    //     $label[0]['nomorUrut'] = $offset;
                    // }
                    // $data['label'] = $label;

                    // return $label;

                    
                }
                
            }
     
            
            
            
        }
        
        $dokterCount++;
        
    
        
        
        
            
        

    

         }
         else {
            $data["poli"] = "";
         }
         
        
        //  $data['totalPasienTujuan'] = count($tujuan_dokter[0]);
        //  dd(rsort($tujuan_dokter[0]));
             
        //  $tujuan_dokter = $tujuan_dokter;
        //  $data['tujuan_dokter'] = $tujuan_dokter;
        //  return $tujuan_dokter;
         $pdf = PDF::loadView('print.tracer_v2', $data)->setPaper('A8', 'portrait');
         return $pdf->stream();

         // return view('print.label', $data);
         // return $pdf->download('laporan-pdf.pdf')
     }

     public function templateLaboratorium($id, $awalan, $tgl_masuk, $status, $nama_dokter, $nama_petugas_lab, $tarif, $total_tarif)

     {

        // $var = 'a/asdas/fgdfg/zfdvs/sdfh';
        $array = explode(',', $tarif);
       
    //    $aaa = json_encode($array);
    // return $array;
        // dd($array);
        foreach ($array as $values)
        {
            // echo $values;
            // echo "<br>";
            echo ''.$values.'<br/>';    
        }

        $data['array'] = $array;
        // return $array;

       

        // return $array;

        // $ada = json_encode($array);
        

        
         // dd($awalan);

        $label = Data::where('NORM',  $id)->get();
        $norm = $label[0]->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }

        $parts = str_split($norm, $split_length = 2);

        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));

        $label[0]['NORM'] = $norm;
        $label[0]['TANGGAL_LAHIR'] = $lahir;
        $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
        $data['label'] = $label;

        // // $count = count($label);
        // // $data['count'] = $count;
        $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
        $data['TANGGAL_MASUK'] = $tanggal_masuk;

        $data['STATUS'] = $status;
        $data['DOKTER'] = $nama_dokter;
        $data['PETUGAS_LAB'] = $nama_petugas_lab;
        // $data['TINDAKAN'] = $tindakan;
        

        // $data['TARIF'] = $array;

        $data['TOTAL_TARIF'] = $total_tarif;

        
        // $pdf = PDF::loadView('print.laboratorium_v2', $data)->setPaper([0,0,311.8110236220472,113.3858267716535], 'landscape');
        // $pdf = PDF::loadView('print.laboratorium_v3', $data)->setPaper([0,0,155.9055118110236,113.3858267716535], 'landscape');
        // $pdf = PDF::loadView('print.laboratorium_v4', $data)->setPaper([0,0,396,684], 'landscape');
        $pdf = PDF::loadView('print.laboratorium_v4', $data)->setPaper('A4', 'portrait');
        // $pdf = PDF::loadView('print.laboratorium_v4', $data)->setPaper([0,0,595.2755905511811,420.9448818897638], 'portrait');
        return $pdf->stream();

        // return view('print.label', $data);
        // return $pdf->download('laporan-pdf.pdf')
     }

     public function templateRadiologi($id, $awalan, $tgl_masuk, $status, $nama_dokter, $tarif, $total_tarif)

     {

          // $var = 'a/asdas/fgdfg/zfdvs/sdfh';
          $array = explode(',', $tarif);
       
          //    $aaa = json_encode($array);
          // return $array;
              // dd($array);
              foreach ($array as $values)
              {
                  // echo $values;
                  // echo "<br>";
                  echo ''.$values.'<br/>';    
              }
      
              $data['array'] = $array;
              // return $array;
      
             
      
              // return $array;
      
              // $ada = json_encode($array);
        


         // dd($awalan);

        $label = Data::where('NORM',  $id)->get();
        $norm = $label[0]->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }

        $parts = str_split($norm, $split_length = 2);

        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));

        $label[0]['NORM'] = $norm;
        $label[0]['TANGGAL_LAHIR'] = $lahir;
        $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
        $data['label'] = $label;

        // // $count = count($label);
        // // $data['count'] = $count;
        $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
        $data['TANGGAL_MASUK'] = $tanggal_masuk;

        $data['STATUS'] = $status;
        $data['DOKTER'] = $nama_dokter;
        
        // $data['TINDAKAN'] = $tindakan;
        

        // $data['TARIF'] = $array;

        $data['TOTAL_TARIF'] = $total_tarif;


        $pdf = PDF::loadView('print.radiologi', $data)->setPaper('A4', 'portrait');
        return $pdf->stream();

        // return view('print.label', $data);
        // return $pdf->download('laporan-pdf.pdf')
     }

     public function testtujuan($id, $awalan, $tgl_masuk)

     {

         // dd($awalan);

         $label = Data::where('NORM',  $id)->get();
         $norm = $label[0]->NORM;
         $length = strlen($norm);
         for ($i=$length; $i < 6; $i++) {
                 $norm = "0" . $norm;
         }

         $parts = str_split($norm, $split_length = 2);

         $norm = $parts[0].".".$parts[1].".".$parts[2];
         $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));

         $label[0]['NORM'] = $norm;
         $label[0]['TANGGAL_LAHIR'] = $lahir;
         $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
         $data['label'] = $label;

         // // $count = count($label);
         // // $data['count'] = $count;
         $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
         $data['TANGGAL_MASUK'] = $tanggal_masuk;
         $data["pendaftaran"] = Pendaftaran::where('NORM', $id)->where('TANGGAL','2020-01-28 17:12:47')->first();
         $data["tujuan"] = Tujuan::where('NOPEN',$data["pendaftaran"]->NOMOR)->first();
         $data["poli"] = Ruang::where('ID',$data["tujuan"]->RUANGAN)->first();
         dd($data);
         $pdf = PDF::loadView('print.gelanganak', $data)->setPaper([0, 0, 70.98, 600.85], 'landscape');
         return $pdf->stream();

        //  return view('print.gelanganak');
        // return $pdf->download('laporan-pdf.pdf');
     }


     public function klaimkronis($id) {
        // dd($awalan);

        // $kunjungan = Kunjungan::where('NOMOR', '1011201012406200201')->where('RUANGAN', 101120101)->first();
        $kunjungan = Kunjungan::where('NOMOR', $id)->where('RUANGAN', 101120101)->first();

        if (!$kunjungan) {
            $joins = null;
        }

        $pendaftaran = Pendaftaran::where('NOMOR', $kunjungan['NOPEN'])->first();

        if (!$pendaftaran) {
            $joins = null;
        }



        $label = Data::where('NORM',  $pendaftaran['NORM'])->get();
        if (!$label) {
            $data = null;
        }
        $norm = $label[0]->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }

        $parts = str_split($norm, $split_length = 2);

        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));
        $nama = $label[0]['NAMA'];

        $label[0]['NORM'] = $norm;
        $label[0]['TANGGAL_LAHIR'] = $lahir;
        
        // // $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
        // $data['label'] = $label;

        // // $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
        // // $data['TANGGAL_MASUK'] = $tanggal_masuk;
        
///////////////////////////////////////////////////////////////////////////////
        $pasien = Pasien::where('NORM',  $pendaftaran['NORM'])->first();
        // $pendaftaran = Pendaftaran::where('NORM', $pasien['NORM'])->orderBy('TANGGAL', 'desc')->first();

        // if (!$pendaftaran) {
        //     $$data = null;
        // }
    
        // $kunjungan = Kunjungan::where('NOPEN', $pendaftaran['NOMOR'])->where('RUANGAN', 101120101)->orderBy('MASUK', 'desc')->first();

        // if (!$kunjungan) {
        //     $data = null;
        // }

        $resep = OrderResep::where('NOMOR', $kunjungan['REF'])->first();

        if (!$resep) {
            $data = null;
        }

        $farmasi = Farmasi::where('KUNJUNGAN', $kunjungan['NOMOR'])->first();

        if (!$farmasi) {
            $data = null;
        }

        $pembayaran = RincianTagihan::where('TAGIHAN', $pendaftaran['NOMOR'])->where('JENIS', '4')->first();
        
        if (!$pembayaran) {
            $data = null;
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

        // $obat = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        // ->select('inventory.barang.NAMA',)
        // ->where('layanan.farmasi.STATUS', 2)
        // ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        // ->get();

        // foreach ($obat as $obats) {
        //     $obats['NAMA'];
        // }

        $tarif = Farmasi::join('inventory.barang', 'layanan.farmasi.FARMASI', '=', 'inventory.barang.ID')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.HARI', 30)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        ->get();

        foreach($tarif as $tarifs) {
            if ($tarifs['HARI'] == 30) {
            $tarifs['VKLAIM_KRONIS'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['VKLAIM_INACBG'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['KLAIM_KRONIS'] = 23/30 * $tarifs['VKLAIM_KRONIS'];
            $tarifs['KLAIM_INACBG'] = 7/30 * $tarifs['VKLAIM_INACBG'];
            $tarifs['HASIL_KLAIM_KRONIS'] = round($tarifs['KLAIM_KRONIS'], 2);
            $tarifs['HASIL_KLAIM_INACBG'] = round($tarifs['KLAIM_INACBG'], 2);
            $tarifs['QTY_KRONIS'] = 23/30 * $tarifs['JUMLAH'];
            $tarifs['QTY_INACBG'] = 7/30 * $tarifs['JUMLAH'];
            $tarifs['HASIL_QTY_KRONIS'] = round($tarifs['QTY_KRONIS'], 2);
            $tarifs['HASIL_QTY_INACBG'] = round($tarifs['QTY_INACBG'], 2);
            // $tarifs['QTY_KRONISX1'] = substr($tarifs['QTY_KRONIS'],0,4);
            // $tarifs['QTY_INACBGX1'] = substr($tarifs['QTY_INACBG'],0,4);
            // $tarifs['QTY_KRONISY'] = floatval($tarifs['QTY_KRONISX1']);
            // $tarifs['QTY_INACBGY'] = floatval($tarifs['QTY_INACBGX1']);
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF']; 
            } else {
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];  
            }
        }

        $data['TOTAL_KRONIS'] = $tarif->sum('KLAIM_KRONIS');
        $data['HASIL_TOTAL_KRONIS'] = round($data['TOTAL_KRONIS'], 2);


        $tagihan = Tagihan::where('pembayaran.tagihan.ID', $pendaftaran['NOMOR'])
        ->select('pembayaran.tagihan.ID', 'pembayaran.tagihan.REF', 'pembayaran.tagihan.TOTAL')
        ->where('pembayaran.tagihan.JENIS', 1)
        ->first();

      

        $join = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN'])  //$kunjungan['NOMOR']
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->first();


        // foreach ($join as $joins) {
        //     if ($joins['HARI'] == 30) {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         $joins['JUMLAH'];
        //         $joins['TARIF'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['KLAIM_KRONIS'] = 23/30 * $pembayaran['TARIF'];
        //         // $joins['KLAIM_INACBG'] = 7/30 *  $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'DIBAGI DUA 23 & 7 hari';
        //     } else {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'TIDAK DIBAGI DUA';
        //     }
    
        //  }

        }

        // $data['obat'] = $obat;
        $data['label'] = $label;
        $data['pasien'] = $pasien;
        $data['tarif'] = $tarif;
        $data['tagihan'] = $tagihan;
        $data['ruangan'] = $ruangan;
        $data['dokter'] = $dokters;
        $data['kunjungan'] = $kunjungan;

        // $hasilpasien = $join;
        // $data['listresep'] = $hasilpasien;
        // return response()->json($data);

        $pdf = PDF::loadView('print.klaimkronis', $data)->setPaper(array(0, 0, 164.409448818, 600.409448818), 'portrait');
        return $pdf->stream();
     }

     public function klaiminacbg($id) {
        // dd($awalan);
        // $kunjungan = Kunjungan::where('NOMOR', '1011201012406200201')->where('RUANGAN', 101120101)->first();
        $kunjungan = Kunjungan::where('NOMOR', $id)->where('RUANGAN', 101120101)->first();

        if (!$kunjungan) {
            $data = null;
        }

        $pendaftaran = Pendaftaran::where('NOMOR', $kunjungan['NOPEN'])->first();

        if (!$pendaftaran) {
            $data = null;
        }



        $label = Data::where('NORM',  $pendaftaran['NORM'])->get();
        if (!$label) {
            $data = null;
        }
        $norm = $label[0]->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }

        $parts = str_split($norm, $split_length = 2);

        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));
        $nama = $label[0]['NAMA'];

        $label[0]['NORM'] = $norm;
        $label[0]['TANGGAL_LAHIR'] = $lahir;
        
        // // $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
        // $data['label'] = $label;

        // // $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
        // // $data['TANGGAL_MASUK'] = $tanggal_masuk;
        
///////////////////////////////////////////////////////////////////////////////
        $pasien = Pasien::where('NORM',  $pendaftaran['NORM'])->first();
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
            $data = null;
        }

        $farmasi = Farmasi::where('KUNJUNGAN', $kunjungan['NOMOR'])->first();

        if (!$farmasi) {
            $data = null;
        }

        $pembayaran = RincianTagihan::where('TAGIHAN', $pendaftaran['NOMOR'])->where('JENIS', '4')->first();
        
        if (!$pembayaran) {
            $data = null;
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

        // $obat = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        // ->select('inventory.barang.NAMA',)
        // ->where('layanan.farmasi.STATUS', 2)
        // ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        // ->get();

        // foreach ($obat as $obats) {
        //     $obats['NAMA'];
        // }

        $tarif = Farmasi::join('inventory.barang', 'layanan.farmasi.FARMASI', '=', 'inventory.barang.ID')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->where('layanan.farmasi.STATUS', 2)
        // ->where('layanan.farmasi.HARI', 30)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        ->get();

        foreach($tarif as $tarifs) {
            if ($tarifs['HARI'] == 30) {
            $tarifs['VKLAIM_KRONIS'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['VKLAIM_INACBG'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['KLAIM_KRONIS'] = 23/30 * $tarifs['VKLAIM_KRONIS'];
            $tarifs['KLAIM_INACBG'] = 7/30 * $tarifs['VKLAIM_INACBG'];
            $tarifs['HASIL_KLAIM_KRONIS'] = round($tarifs['KLAIM_KRONIS'], 2);
            $tarifs['HASIL_KLAIM_INACBG'] = round($tarifs['KLAIM_INACBG'], 2);
            $tarifs['QTY_KRONIS'] = 23/30 * $tarifs['JUMLAH'];
            $tarifs['QTY_INACBG'] = 7/30 * $tarifs['JUMLAH'];
            $tarifs['HASIL_QTY_KRONIS'] = round($tarifs['QTY_KRONIS'], 2);
            $tarifs['HASIL_QTY_INACBG'] = round($tarifs['QTY_INACBG'], 2);
            // $tarifs['QTY_KRONISX'] = substr($tarifs['QTY_KRONIS'],0,4);
            // $tarifs['QTY_INACBGX'] = substr($tarifs['QTY_INACBG'],0,4);
            // $tarifs['QTY_KRONISY'] = floatval($tarifs['QTY_KRONISX']);
            // $tarifs['QTY_INACBGY'] = floatval($tarifs['QTY_INACBGX']);
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF']; 
            } else {
            $tarifs['KLAIM_INACBG'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];   
            $tarifs['HASIL_KLAIM_INACBG'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $subject = $tarifs['JUMLAH'];
            $search = '.00';
            $tarifs['HASIL_QTY_INACBG'] = str_replace($search, '', $subject) ;   
            }
        }

        $data['TOTAL_INACBG'] = $tarif->sum('KLAIM_INACBG');
        $data['HASIL_TOTAL_INACBG'] = round($data['TOTAL_INACBG'], 2);


        $tagihan = Tagihan::where('pembayaran.tagihan.ID', $pendaftaran['NOMOR'])
        ->select('pembayaran.tagihan.ID', 'pembayaran.tagihan.REF', 'pembayaran.tagihan.TOTAL')
        ->where('pembayaran.tagihan.JENIS', 1)
        ->first();

      

        $join = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN'])  //$kunjungan['NOMOR']
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->first();


        // foreach ($join as $joins) {
        //     if ($joins['HARI'] == 30) {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         $joins['JUMLAH'];
        //         $joins['TARIF'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['KLAIM_KRONIS'] = 23/30 * $pembayaran['TARIF'];
        //         // $joins['KLAIM_INACBG'] = 7/30 *  $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'DIBAGI DUA 23 & 7 hari';
        //     } else {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'TIDAK DIBAGI DUA';
        //     }
    
        //  }

        }

        // $data['obat'] = $obat;
        $data['label'] = $label;
        $data['pasien'] = $pasien;
        $data['tarif'] = $tarif;
        $data['tagihan'] = $tagihan;
        $data['ruangan'] = $ruangan;
        $data['dokter'] = $dokters;
        $data['kunjungan'] = $kunjungan;

        // $hasilpasien = $join;
        // $data['listresep'] = $hasilpasien;
        // return response()->json($data);

        $pdf = PDF::loadView('print.klaiminacbg', $data)->setPaper(array(0, 0, 164.409448818, 600.409448818), 'portrait');
        return $pdf->stream();
     }

     public function klaimnormal($id) {
        // dd($awalan);
        // $kunjungan = Kunjungan::where('NOMOR', '1011201012406200201')->where('RUANGAN', 101120101)->first();
        $kunjungan = Kunjungan::where('NOMOR', $id)->where('RUANGAN', 101120101)->first();

        if (!$kunjungan) {
            $data = null;
        }

        $pendaftaran = Pendaftaran::where('NOMOR', $kunjungan['NOPEN'])->first();

        if (!$pendaftaran) {
            $data = null;
        }



        $label = Data::where('NORM',  $pendaftaran['NORM'])->get();
        if (!$label) {
            $data = null;
        }
        $norm = $label[0]->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }

        $parts = str_split($norm, $split_length = 2);

        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));
        $nama = $label[0]['NAMA'];

        $label[0]['NORM'] = $norm;
        $label[0]['TANGGAL_LAHIR'] = $lahir;
        
        // // $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
        // $data['label'] = $label;

        // // $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
        // // $data['TANGGAL_MASUK'] = $tanggal_masuk;
        
///////////////////////////////////////////////////////////////////////////////
        $pasien = Pasien::where('NORM',  $pendaftaran['NORM'])->first();
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
            $data = null;
        }

        $farmasi = Farmasi::where('KUNJUNGAN', $kunjungan['NOMOR'])->first();

        if (!$farmasi) {
            $data = null;
        }

        $pembayaran = RincianTagihan::where('TAGIHAN', $pendaftaran['NOMOR'])->where('JENIS', '4')->first();
        
        if (!$pembayaran) {
            $data = null;
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

        // $obat = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        // ->select('inventory.barang.NAMA',)
        // ->where('layanan.farmasi.STATUS', 2)
        // ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        // ->get();

        // foreach ($obat as $obats) {
        //     $obats['NAMA'];
        // }

        $tarif = Farmasi::join('inventory.barang', 'layanan.farmasi.FARMASI', '=', 'inventory.barang.ID')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        ->get();

        foreach($tarif as $tarifs) {
            if ($tarifs['HARI'] == 30) {
            $tarifs['VKLAIM_KRONIS'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['VKLAIM_INACBG'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['KLAIM_KRONIS'] = 23/30 * $tarifs['VKLAIM_KRONIS'];
            $tarifs['KLAIM_INACBG'] = 7/30 * $tarifs['VKLAIM_INACBG'];
            $tarifs['HASIL_KLAIM_KRONIS'] = round($tarifs['KLAIM_KRONIS'], 2);
            $tarifs['HASIL_KLAIM_INACBG'] = round($tarifs['KLAIM_INACBG'], 2);
            $tarifs['QTY_KRONIS'] = 23/30 * $tarifs['JUMLAH'];
            $tarifs['QTY_INACBG'] = 7/30 * $tarifs['JUMLAH'];
            $tarifs['HASIL_QTY_KRONIS'] = round($tarifs['QTY_KRONIS'], 2);
            $tarifs['HASIL_QTY_INACBG'] = round($tarifs['QTY_INACBG'], 2);
            // $tarifs['QTY_KRONISX'] = substr($tarifs['QTY_KRONIS'],0,4);
            // $tarifs['QTY_INACBGX'] = substr($tarifs['QTY_INACBG'],0,4);
            // $tarifs['QTY_KRONISY'] = floatval($tarifs['QTY_KRONISX']);
            // $tarifs['QTY_INACBGY'] = floatval($tarifs['QTY_INACBGX']);
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $subject = $tarifs['JUMLAH'];
            $search = '.00';
            $tarifs['XJUMLAH'] = str_replace($search, '', $subject) ; 
            } else {
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $subject = $tarifs['JUMLAH'];
            $search = '.00';
            $tarifs['XJUMLAH'] = str_replace($search, '', $subject) ;   
            }
        }

        $data['TOTAL_NORMAL'] = $tarif->sum('KLAIM_NORMAL');
        $data['HASIL_TOTAL_NORMAL'] = round($data['TOTAL_NORMAL'], 2);


        $tagihan = Tagihan::where('pembayaran.tagihan.ID', $pendaftaran['NOMOR'])
        ->select('pembayaran.tagihan.ID', 'pembayaran.tagihan.REF', 'pembayaran.tagihan.TOTAL')
        ->where('pembayaran.tagihan.JENIS', 1)
        ->first();

      

        $join = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN'])  //$kunjungan['NOMOR']
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->first();


        // foreach ($join as $joins) {
        //     if ($joins['HARI'] == 30) {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         $joins['JUMLAH'];
        //         $joins['TARIF'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['KLAIM_KRONIS'] = 23/30 * $pembayaran['TARIF'];
        //         // $joins['KLAIM_INACBG'] = 7/30 *  $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'DIBAGI DUA 23 & 7 hari';
        //     } else {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'TIDAK DIBAGI DUA';
        //     }
    
        //  }

        }

        // $data['obat'] = $obat;
        $data['label'] = $label;
        $data['pasien'] = $pasien;
        $data['tarif'] = $tarif;
        $data['tagihan'] = $tagihan;
        $data['ruangan'] = $ruangan;
        $data['dokter'] = $dokters;
        $data['kunjungan'] = $kunjungan;

        // $hasilpasien = $join;
        // $data['listresep'] = $hasilpasien;
        // return response()->json($data);

        $pdf = PDF::loadView('print.klaimnormal', $data)->setPaper(array(0, 0, 164.409448818, 600.409448818), 'portrait');
        return $pdf->stream();
     }





     public function klaimkronisV($id) {
        // dd($awalan);

        $label = Data::where('NORM',  $id)->get();
        if (!$label) {
            $data = null;
        }
        $norm = $label[0]->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }

        $parts = str_split($norm, $split_length = 2);

        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));
        $nama = $label[0]['NAMA'];

        $label[0]['NORM'] = $norm;
        $label[0]['TANGGAL_LAHIR'] = $lahir;
        
        // // $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
        // $data['label'] = $label;

        // // $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
        // // $data['TANGGAL_MASUK'] = $tanggal_masuk;
        
///////////////////////////////////////////////////////////////////////////////
        $pasien = Pasien::where('NORM',  $id)->first();
        $pendaftaran = Pendaftaran::where('NORM', $pasien['NORM'])->orderBy('TANGGAL', 'desc')->first();

        if (!$pendaftaran) {
            $$data = null;
        }
    
        $kunjungan = Kunjungan::where('NOPEN', $pendaftaran['NOMOR'])->where('RUANGAN', 101120101)->orderBy('MASUK', 'desc')->first();

        if (!$kunjungan) {
            $data = null;
        }

        $resep = OrderResep::where('NOMOR', $kunjungan['REF'])->first();

        if (!$resep) {
            $data = null;
        }

        $farmasi = Farmasi::where('KUNJUNGAN', $kunjungan['NOMOR'])->first();

        if (!$farmasi) {
            $data = null;
        }

        $pembayaran = RincianTagihan::where('TAGIHAN', $pendaftaran['NOMOR'])->where('JENIS', '4')->first();
        
        if (!$pembayaran) {
            $data = null;
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

        // $obat = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        // ->select('inventory.barang.NAMA',)
        // ->where('layanan.farmasi.STATUS', 2)
        // ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        // ->get();

        // foreach ($obat as $obats) {
        //     $obats['NAMA'];
        // }

        $tarif = Farmasi::join('inventory.barang', 'layanan.farmasi.FARMASI', '=', 'inventory.barang.ID')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.HARI', 30)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        ->get();

        foreach($tarif as $tarifs) {
            if ($tarifs['HARI'] == 30) {
            $tarifs['VKLAIM_KRONIS'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['VKLAIM_INACBG'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['KLAIM_KRONIS'] = 23/30 * $tarifs['VKLAIM_KRONIS'];
            $tarifs['KLAIM_INACBG'] = 7/30 * $tarifs['VKLAIM_INACBG'];
            $tarifs['QTY_KRONIS'] = 23/30 * $tarifs['JUMLAH'];
            $tarifs['QTY_INACBG'] = 7/30 * $tarifs['JUMLAH'];
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF']; 
            } else {
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];  
            }
        }

        $data['TOTAL_KRONIS'] = $tarif->sum('KLAIM_KRONIS');


        $tagihan = Tagihan::where('pembayaran.tagihan.ID', $pendaftaran['NOMOR'])
        ->select('pembayaran.tagihan.ID', 'pembayaran.tagihan.REF', 'pembayaran.tagihan.TOTAL')
        ->where('pembayaran.tagihan.JENIS', 1)
        ->first();

      

        $join = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN'])  //$kunjungan['NOMOR']
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->first();


        // foreach ($join as $joins) {
        //     if ($joins['HARI'] == 30) {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         $joins['JUMLAH'];
        //         $joins['TARIF'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['KLAIM_KRONIS'] = 23/30 * $pembayaran['TARIF'];
        //         // $joins['KLAIM_INACBG'] = 7/30 *  $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'DIBAGI DUA 23 & 7 hari';
        //     } else {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'TIDAK DIBAGI DUA';
        //     }
    
        //  }

        }

        // $data['obat'] = $obat;
        $data['label'] = $label;
        $data['pasien'] = $pasien;
        $data['tarif'] = $tarif;
        $data['tagihan'] = $tagihan;
        $data['ruangan'] = $ruangan;
        $data['dokter'] = $dokters;
        $data['kunjungan'] = $kunjungan;

        // $hasilpasien = $join;
        // $data['listresep'] = $hasilpasien;
        // return response()->json($data);

        $pdf = PDF::loadView('print.klaimkronis', $data)->setPaper(array(0, 0, 164.409448818, 600.409448818), 'portrait');
        return $pdf->stream();
     }

     public function klaiminacbgV($id) {
        // dd($awalan);

        $label = Data::where('NORM',  $id)->get();
        if (!$label) {
            $data = null;
        }
        $norm = $label[0]->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }

        $parts = str_split($norm, $split_length = 2);

        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));
        $nama = $label[0]['NAMA'];

        $label[0]['NORM'] = $norm;
        $label[0]['TANGGAL_LAHIR'] = $lahir;
        
        // // $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
        // $data['label'] = $label;

        // // $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
        // // $data['TANGGAL_MASUK'] = $tanggal_masuk;
        
///////////////////////////////////////////////////////////////////////////////
        $pasien = Pasien::where('NORM',  $id)->first();
        $pendaftaran = Pendaftaran::where('NORM', $pasien['NORM'])->orderBy('TANGGAL', 'desc')->first();

        if (!$pendaftaran) {
            $data = null;
        }
    
        $kunjungan = Kunjungan::where('NOPEN', $pendaftaran['NOMOR'])->where('RUANGAN', 101120101)->orderBy('MASUK', 'desc')->first();

        if (!$kunjungan) {
            $data = null;
        }

        $resep = OrderResep::where('NOMOR', $kunjungan['REF'])->first();

        if (!$resep) {
            $data = null;
        }

        $farmasi = Farmasi::where('KUNJUNGAN', $kunjungan['NOMOR'])->first();

        if (!$farmasi) {
            $data = null;
        }

        $pembayaran = RincianTagihan::where('TAGIHAN', $pendaftaran['NOMOR'])->where('JENIS', '4')->first();
        
        if (!$pembayaran) {
            $data = null;
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

        // $obat = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        // ->select('inventory.barang.NAMA',)
        // ->where('layanan.farmasi.STATUS', 2)
        // ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        // ->get();

        // foreach ($obat as $obats) {
        //     $obats['NAMA'];
        // }

        $tarif = Farmasi::join('inventory.barang', 'layanan.farmasi.FARMASI', '=', 'inventory.barang.ID')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.HARI', 30)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        ->get();

        foreach($tarif as $tarifs) {
            if ($tarifs['HARI'] == 30) {
            $tarifs['VKLAIM_KRONIS'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['VKLAIM_INACBG'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['KLAIM_KRONIS'] = 23/30 * $tarifs['VKLAIM_KRONIS'];
            $tarifs['KLAIM_INACBG'] = 7/30 * $tarifs['VKLAIM_INACBG'];
            $tarifs['QTY_KRONIS'] = 23/30 * $tarifs['JUMLAH'];
            $tarifs['QTY_INACBG'] = 7/30 * $tarifs['JUMLAH'];
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF']; 
            } else {
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];  
            }
        }

        $data['TOTAL_INACBG'] = $tarif->sum('KLAIM_INACBG');


        $tagihan = Tagihan::where('pembayaran.tagihan.ID', $pendaftaran['NOMOR'])
        ->select('pembayaran.tagihan.ID', 'pembayaran.tagihan.REF', 'pembayaran.tagihan.TOTAL')
        ->where('pembayaran.tagihan.JENIS', 1)
        ->first();

      

        $join = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN'])  //$kunjungan['NOMOR']
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->first();


        // foreach ($join as $joins) {
        //     if ($joins['HARI'] == 30) {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         $joins['JUMLAH'];
        //         $joins['TARIF'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['KLAIM_KRONIS'] = 23/30 * $pembayaran['TARIF'];
        //         // $joins['KLAIM_INACBG'] = 7/30 *  $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'DIBAGI DUA 23 & 7 hari';
        //     } else {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'TIDAK DIBAGI DUA';
        //     }
    
        //  }

        }

        // $data['obat'] = $obat;
        $data['label'] = $label;
        $data['pasien'] = $pasien;
        $data['tarif'] = $tarif;
        $data['tagihan'] = $tagihan;
        $data['ruangan'] = $ruangan;
        $data['dokter'] = $dokters;
        $data['kunjungan'] = $kunjungan;

        // $hasilpasien = $join;
        // $data['listresep'] = $hasilpasien;
        // return response()->json($tarif);

        $pdf = PDF::loadView('print.klaiminacbg', $data)->setPaper(array(0, 0, 164.409448818, 600.409448818), 'portrait');
        return $pdf->stream();
     }

     public function klaimnormalV($id) {
        // dd($awalan);

        $label = Data::where('NORM',  $id)->get();
        if (!$label) {
            $data = null;
        }
        $norm = $label[0]->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }

        $parts = str_split($norm, $split_length = 2);

        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $lahir = date("d/m/Y", strtotime($label[0]['TANGGAL_LAHIR']));
        $nama = $label[0]['NAMA'];

        $label[0]['NORM'] = $norm;
        $label[0]['TANGGAL_LAHIR'] = $lahir;
        
        // // $label[0]['NAMA'] = $awalan.' '.$label[0]['NAMA'];
        // $data['label'] = $label;

        // // $tanggal_masuk = date("d/m/Y", strtotime($tgl_masuk));
        // // $data['TANGGAL_MASUK'] = $tanggal_masuk;
        
///////////////////////////////////////////////////////////////////////////////
        $pasien = Pasien::where('NORM',  $id)->first();
        $pendaftaran = Pendaftaran::where('NORM', $pasien['NORM'])->orderBy('TANGGAL', 'desc')->first();

        if (!$pendaftaran) {
            $data = null;
        }
    
        $kunjungan = Kunjungan::where('NOPEN', $pendaftaran['NOMOR'])->where('RUANGAN', 101120101)->orderBy('MASUK', 'desc')->first();

        if (!$kunjungan) {
            $data = null;
        }

        $resep = OrderResep::where('NOMOR', $kunjungan['REF'])->first();

        if (!$resep) {
            $data = null;
        }

        $farmasi = Farmasi::where('KUNJUNGAN', $kunjungan['NOMOR'])->first();

        if (!$farmasi) {
            $data = null;
        }

        $pembayaran = RincianTagihan::where('TAGIHAN', $pendaftaran['NOMOR'])->where('JENIS', '4')->first();
        
        if (!$pembayaran) {
            $data = null;
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

        // $obat = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        // ->select('inventory.barang.NAMA',)
        // ->where('layanan.farmasi.STATUS', 2)
        // ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        // ->get();

        // foreach ($obat as $obats) {
        //     $obats['NAMA'];
        // }

        $tarif = Farmasi::join('inventory.barang', 'layanan.farmasi.FARMASI', '=', 'inventory.barang.ID')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN']) //$kunjungan['NOMOR']
        ->get();

        foreach($tarif as $tarifs) {
            if ($tarifs['HARI'] == 30) {
            $tarifs['VKLAIM_KRONIS'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['VKLAIM_INACBG'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $tarifs['KLAIM_KRONIS'] = 23/30 * $tarifs['VKLAIM_KRONIS'];
            $tarifs['KLAIM_INACBG'] = 7/30 * $tarifs['VKLAIM_INACBG'];
            $tarifs['QTY_KRONIS'] = 23/30 * $tarifs['JUMLAH'];
            $tarifs['QTY_INACBG'] = 7/30 * $tarifs['JUMLAH'];
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $subject = $tarifs['JUMLAH'];
            $search = '.00';
            $tarifs['XJUMLAH'] = str_replace($search, '', $subject) ; 
            } else {
            $tarifs['KLAIM_NORMAL'] = $tarifs['JUMLAH'] * $tarifs['TARIF'];
            $subject = $tarifs['JUMLAH'];
            $search = '.00';
            $tarifs['XJUMLAH'] = str_replace($search, '', $subject) ;   
            }
        }

        $data['TOTAL_NORMAL'] = $tarif->sum('KLAIM_NORMAL');


        $tagihan = Tagihan::where('pembayaran.tagihan.ID', $pendaftaran['NOMOR'])
        ->select('pembayaran.tagihan.ID', 'pembayaran.tagihan.REF', 'pembayaran.tagihan.TOTAL')
        ->where('pembayaran.tagihan.JENIS', 1)
        ->first();

      

        $join = Barang::join('layanan.farmasi', 'inventory.barang.ID', '=', 'layanan.farmasi.FARMASI')
        ->join('pembayaran.rincian_tagihan', 'layanan.farmasi.ID', '=', 'pembayaran.rincian_tagihan.REF_ID')
        ->select('inventory.barang.NAMA', 'layanan.farmasi.KUNJUNGAN', 'layanan.farmasi.HARI', 'layanan.farmasi.TANGGAL', 'layanan.farmasi.STATUS', 'pembayaran.rincian_tagihan.JUMLAH', 'pembayaran.rincian_tagihan.TARIF', 'pembayaran.rincian_tagihan.JENIS')
        ->where('layanan.farmasi.STATUS', 2)
        ->where('layanan.farmasi.KUNJUNGAN', $farmasi['KUNJUNGAN'])  //$kunjungan['NOMOR']
        ->where('pembayaran.rincian_tagihan.JENIS', 4)
        ->first();


        // foreach ($join as $joins) {
        //     if ($joins['HARI'] == 30) {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         $joins['JUMLAH'];
        //         $joins['TARIF'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['KLAIM_KRONIS'] = 23/30 * $pembayaran['TARIF'];
        //         // $joins['KLAIM_INACBG'] = 7/30 *  $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'DIBAGI DUA 23 & 7 hari';
        //     } else {
        //         $joins['NORM'] = $norm;
        //         $joins['NAMA'];
        //         $joins['TANGGAL_LAHIR'] = $lahir;
        //         $joins['JENIS_KELAMIN'] = $pasien['JENIS_KELAMIN'];
        //         $joins['NAMA_PASIEN'] = $nama;
        //         $joins['UNIT'] = $ruangan['DESKRIPSI'];
        //         $joins['DPJP'] = $dokters['NAMA_GELAR'];
        //         // $joins['TARIF_AWAL'] = $pembayaran['TARIF'];
        //         // $joins['QTY'] = $pembayaran['JUMLAH'];
        //         $joins['KUNJUNGAN'];
        //         $joins['KETERANGAN'] = 'TIDAK DIBAGI DUA';
        //     }
    
        //  }

        }

        // $data['obat'] = $obat;
        $data['label'] = $label;
        $data['pasien'] = $pasien;
        $data['tarif'] = $tarif;
        $data['tagihan'] = $tagihan;
        $data['ruangan'] = $ruangan;
        $data['dokter'] = $dokters;
        $data['kunjungan'] = $kunjungan;

        // $hasilpasien = $join;
        // $data['listresep'] = $hasilpasien;
        // return response()->json($tarif);

        $pdf = PDF::loadView('print.klaimnormal', $data)->setPaper(array(0, 0, 164.409448818, 600.409448818), 'portrait');
        return $pdf->stream();
     }


     public function triage($id) {

      

        // $pendaftaran = Pendaftaran::where('NOMOR', '2406300077')->first();
        $pendaftaran = Pendaftaran::where('NOMOR', $id)->first();

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

        $kedatangan = $triages->KEDATANGAN; 
        $arr = json_decode($kedatangan, TRUE);

        $kasus = $triages->KASUS; 
        $arr2 = json_decode($kasus, TRUE);

        $anamnese = $triages->ANAMNESE; 
        $arr3 = json_decode($anamnese, TRUE);

        $tandaVital = $triages->TANDA_VITAL; 
        $arr4 = json_decode($tandaVital, TRUE);
    
        $obgyn = $triages->OBGYN; 
        $arr5 = json_decode($obgyn, TRUE);

        $kebutuhanKhusus = $triages->KEBUTUHAN_KHUSUS; 
        $arr6 = json_decode($kebutuhanKhusus, TRUE);

        $pemeriksaanKategori = $triages->KATEGORI_PEMERIKSAAN; 
        // $arr7 = json_decode($pemeriksaanKategori, TRUE);

        $pemeriksaanResusitasi = $triages->RESUSITASI; 
        $arr8 = json_decode($pemeriksaanResusitasi, TRUE);

        $pemeriksaanEmergency = $triages->EMERGENCY; 
        $arr9 = json_decode($pemeriksaanEmergency, TRUE);

        $pemeriksaanUrgent = $triages->URGENT; 
        $arr10 = json_decode($pemeriksaanUrgent, TRUE);

        $pemeriksaanLessUrgent = $triages->LESS_URGENT; 
        $arr11 = json_decode($pemeriksaanLessUrgent, TRUE);

        $pemeriksaanNonUrgent = $triages->NON_URGENT; 
        $arr12 = json_decode($pemeriksaanNonUrgent, TRUE);

        $pemeriksaanDoa = $triages->DOA; 
        $arr13 = json_decode($pemeriksaanDoa, TRUE);
        
        $kriteria = $triages->KRITERIA; 
        // $arr14 = json_decode($kriteria, TRUE);

        $handover = $triages->HANDOVER; 
        // $arr15 = json_decode($handover, TRUE);

        $plan = $triages->PLAN; 
        // $arr16 = json_decode($plan, TRUE);

     
        
    }
 


        $data['kedatangan_jenis'] = $arr['JENIS'];
        $data['kedatangan_tanggal'] = $arr['TANGGAL'];
        $data['kedatangan_pengantar'] = $arr['PENGANTAR'];
        $data['kedatangan_kepolisian'] = $arr['KEPOLISIAN'];
        $data['kedatangan_asal_rujukan'] = $arr['ASAL_RUJUKAN'];
        $data['kedatangan_alat_transportasi'] = $arr['ALAT_TRANSPORTASI'];

        $data['kasus_jenis'] = $arr2['JENIS'];
        $data['kasus_dimana'] = $arr2['DIMANA'];

        $data['anamnese_terpimpin'] = $arr3['TERPIMPIN'];
        $data['anamnese_keluhan_utama'] = $arr3['KELUHAN_UTAMA'];

        $data['tanda_vital_suhu'] = $arr4['SUHU'];
        $data['tanda_vital_sistole'] = $arr4['SISTOLE'];
        $data['tanda_vital_diastole'] = $arr4['DIASTOLE'];
        $data['tanda_vital_frek_nadi'] = $arr4['FREK_NADI'];
        $data['tanda_vital_frek_nafas'] = $arr4['FREK_NAFAS'];
        $data['tanda_vital_metode_ukur'] = $arr4['METODE_UKUR'];
        $data['tanda_vital_skala_nyeri'] = $arr4['SKALA_NYERI'];

        $data['obgyn_usia_gestasi'] = $arr5['USIA_GESTASI'];
        $data['obgyn_detak_jantung'] = $arr5['DETAK_JANTUNG'];
        $data['obgyn_dilatasi_serviks'] = $arr5['DILATASI_SERVIKS'];
        $data['obgyn_kontraksi_uterus'] = $arr5['KONTRAKSI_UTERUS'];

        $data['kebutuhan_khusus_airbone'] = $arr6['AIRBONE'];
        $data['kebutuhan_khusus_dekontaminan'] = $arr6['DEKONTAMINAN'];

        $data['pemeriksaan_kategori'] = $pemeriksaanKategori;
        $data['pemeriksaan_resusitasi_checked'] = $arr8['CHECKED'];
        $data['pemeriksaan_emergency_checked'] = $arr9['CHECKED'];
        $data['pemeriksaan_urgent_checked'] = $arr10['CHECKED'];
        $data['pemeriksaan_less_urgent_checked'] = $arr11['CHECKED'];
        $data['pemeriksaan_non_urgent_checked'] = $arr12['CHECKED'];
        $data['pemeriksaan_doa_checked'] = $arr13['CHECKED'];

        $data['kriteria'] = $kriteria;
        $data['handover'] =$handover;
        $data['plan'] = $plan;

        $data['triage'] = $triage;
        $data['pasien'] = $pasien;
        $data['ruangan'] = $ruangan;
        $data['dokter'] = $dokter;


        // return response()->json($data);

        $pdf = PDF::loadView('print.triage', $data)->setPaper('A4', 'portrait');
        return $pdf->stream();
     }

}
