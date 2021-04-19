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

     public function templateTracerV2($id, $awalan, $tgl_masuk, $peminjam)

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

         $data["pendaftaran"] = Pendaftaran::where('NORM', $id)->whereDate('TANGGAL', Carbon::now()->subDays(10))->first();
         if ($data["pendaftaran"]) {
            $data["tujuan"] = Tujuan::where('NOPEN',$data["pendaftaran"]->NOMOR)->first();
            $data["ruangan"] = Ruang::where('ID',$data["tujuan"]->RUANGAN)->first();
            $data["poli"] = $data["ruangan"]["DESKRIPSI"];
            $data["dokter_ruangan"] = DokterRuangan::where('RUANGAN',$data["ruangan"]->ID)->first();
            $data['dokter'] = Dokter::where('ID',$data["dokter_ruangan"]->DOKTER)->first();
            $data['dokter_tujuan'] = Tujuan::where('Dokter',$data["dokter"]->ID)->where('NOPEN', $data["pendaftaran"]->NOMOR)->first();
            $data['pegawai'] = Pegawai::where('NIP', $data['dokter']->NIP)->first();

            $data['nama_dokter'] = $data['pegawai']->GELAR_DEPAN.'. '.$data['pegawai']->NAMA.'. '.$data['pegawai']->GELAR_BELAKANG;

         

        //     foreach ($data["dokter_ruangan"] as $dokter_ruangans) {
                
                // if ($cek['STATUS'] === 1) {
                //     $dokter[] = Dokter::where('ID',$dokter_ruangans['DOKTER'])->first();
                // }
        //     }
           
              
         
           

         }
         else {
            $data["poli"] = "";
         }


        //  dd($data);

         
         $pdf = PDF::loadView('print.tracer_v2', $data)->setPaper('A8', 'portrait');
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
}
