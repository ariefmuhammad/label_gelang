<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use PDF;
use Carbon\Carbon;

class PrintController extends Controller
{
     // Template
     public function templateLabel($id)

     {


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
        $data['label'] = $label;

        // // $count = count($label);
        // // $data['count'] = $count;
        $data['today'] = date('d/m/Y');

        $pdf = PDF::loadView('print.label', $data)->setPaper([0,0,80.732,170.079], 'landscape');
        return $pdf->stream();

        // return view('print.label', $data);
        // return $pdf->download('laporan-pdf.pdf')
     }

     public function templateGelangDewasa($id)

     {

        $label = Data::where('NORM',  $id)->get();

        $data['label'] = $label;

        // $count = count($label);
        // $data['count'] = $count;
        $data['today'] = date('d/m/Y');

        $pdf = PDF::loadView('print.gelangdewasa', $data)->setPaper([0, 0, 70.98, 600.85], 'landscape');
        return $pdf->stream();

        // return view('print.gelangdewasa', compact('label'));
        // return $pdf->download('laporan-pdf.pdf')
     }

     public function templateGelangAnak($id)

     {

         $label = Data::where('NORM',  $id)->get();

         $data['label'] = $label;

         // $count = count($label);
         // $data['count'] = $count;
         $data['today'] = date('d/m/Y');

         $pdf = PDF::loadView('print.gelanganak', $data)->setPaper([0, 0, 70.98, 600.85], 'landscape');
         return $pdf->stream();

        //  return view('print.gelanganak');
        // return $pdf->download('laporan-pdf.pdf');
     }

     public function templateTracer()

     {
         $tracer = Data::first();
         $data['tracer'] = $tracer;
         // $count = count($label);
         // $data['count'] = $count;
         $data['today'] = date('d/m/Y');

         $pdf = PDF::loadView('print.tracer', $data);
         // return $pdf->stream();
         return view('print.tracer',$data);
         // return $pdf->download('laporan-pdf.pdf');
        //  adad
     }
}
