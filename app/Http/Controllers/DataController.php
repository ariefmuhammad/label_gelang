<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use App\regPeriksa;
use App\Pasien;
use App\Tujuan;
use App\Pendaftaran;
use App\Ruang;
use App\DokterRuangan;
use App\Dokter;
use App\Pegawai;
use App\Tindakan;
use App\TarifTindakan;
use PDF;
use Carbon\Carbon;

class DataController extends Controller
{

    public function dokter(Request $request)
    {
        $dokter = Pegawai::where('PROFESI', '4')->orderBy('NAMA')->get();


        foreach ($dokter as $dokters) {
            $dokters['NAMA_GELAR'] = $dokters['GELAR_DEPAN'].". ".$dokters['NAMA'].", ".$dokters['GELAR_BELAKANG'];
        }    

        return $dokter;

        // return response()->json([
        //     $data
		// ]);
    }

    public function tindakanLab(Request $request)
    {
        $tindakan = Tindakan::where('JENIS', '15')
        ->join('tarif_tindakan', 'tindakan.ID', '=', 'tarif_tindakan.TINDAKAN')
        ->select('tindakan.ID', 'tindakan.NAMA', 'tarif_tindakan.TARIF')
        ->groupBy('NAMA')
        ->orderBy('NAMA')
        ->get();

      

        foreach ($tindakan as $tindakans) {
     
            $tindakans['NAMA'] = str_replace("/"," atau ", $tindakans['NAMA']);
            $tindakans['TINDAKAN_TARIF'] = str_replace("/"," atau ", $tindakans['NAMA']). " - ". " Rp. " .$tindakans['TARIF'];

            $tindakans['NAMA'] = str_replace(","," & ", $tindakans['NAMA']);
            $tindakans['TINDAKAN_TARIF'] = str_replace(","," & ", $tindakans['NAMA']). " - ". " Rp. " .$tindakans['TARIF'];
            
        }

      

        return $tindakan;
    }

    public function tindakanLabBpjs(Request $request)
    {
        $tindakan = Tindakan::where('JENIS', '77')
        ->join('tarif_tindakan', 'tindakan.ID', '=', 'tarif_tindakan.TINDAKAN')
        ->select('tindakan.ID', 'tindakan.NAMA', 'tarif_tindakan.TARIF')
        ->groupBy('NAMA')
        ->orderBy('NAMA')
        ->get();

      

        foreach ($tindakan as $tindakans) {
     
            $tindakans['NAMA'] = str_replace("/"," atau ", $tindakans['NAMA']);
            $tindakans['TINDAKAN_TARIF'] = str_replace("/"," atau ", $tindakans['NAMA']). " - ". " Rp. " .$tindakans['TARIF'];

            $tindakans['NAMA'] = str_replace(","," & ", $tindakans['NAMA']);
            $tindakans['TINDAKAN_TARIF'] = str_replace(","," & ", $tindakans['NAMA']). " - ". " Rp. " .$tindakans['TARIF'];
            
        }

      

        return $tindakan;
    }


    public function tindakanRadiologi(Request $request)
    {
        $tindakan = Tindakan::where('JENIS', '16')
        ->join('tarif_tindakan', 'tindakan.ID', '=', 'tarif_tindakan.TINDAKAN')
        ->select('tindakan.ID', 'tindakan.NAMA', 'tarif_tindakan.TARIF')
        ->groupBy('NAMA')
        ->orderBy('NAMA')
        ->get();

        foreach ($tindakan as $tindakans) {
     

            $tindakans['NAMA'] = str_replace("/"," atau ", $tindakans['NAMA']);
            $tindakans['TINDAKAN_TARIF'] = str_replace("/"," atau ", $tindakans['NAMA']). " - ". " Rp. " .$tindakans['TARIF'];

            $tindakans['NAMA'] = str_replace(","," & ", $tindakans['NAMA']);
            $tindakans['TINDAKAN_TARIF'] = str_replace(","," & ", $tindakans['NAMA']). " - ". " Rp. " .$tindakans['TARIF'];
        
        }

        return $tindakan;
    }


    public function cari(Request $request)
    {
        $input = $request->cari;
        $data = Data::where('NORM', 'like', '%' . $input . '%')->first();


        $norm = $data->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }
        $parts = str_split($norm, $split_length = 2);
        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $data['NORMTITIK'] = $norm;



        $data['TANGGAL_LAHIR'] = date("d/m/Y", strtotime($data['TANGGAL_LAHIR']));
        return response()->json([
            'cari' => $data
		]);
    }


    public function tracerData()
    {
        //

        $data['pendaftaran'] = Pendaftaran::whereDate('TANGGAL', Carbon::today())->orderBy("TANGGAL", "DESC")->get();

        // dd($data['pendaftaran']);


        $count = 1;
        $nom = 0;

        if(!empty($data['pendaftaran'][0])) {
        foreach ($data['pendaftaran'] as $datas) {

            $data['pasien'][] = Pasien::where('NORM',$datas->NORM)->first();


            $norm = $data['pasien'][$nom]['NORM'];
            $length = strlen($norm);
            for ($i=$length; $i < 6; $i++) {
                    $norm = "0" . $norm;
            }
            $parts = str_split($norm, $split_length = 2);
            $norm = $parts[0].".".$parts[1].".".$parts[2];
            $lahir = date("d/m/Y", strtotime($data['pasien'][$nom]['TANGGAL_LAHIR']));
            $norm = $data['pasien'][$nom]['NORMTITIK'] = $norm;


            $data['pasien'][$nom]['TANGGAL_LAHIR'] = date("d/m/Y", strtotime($data['pasien'][$nom]['TANGGAL_LAHIR']));


            $pendaftaran = Pendaftaran::where('NORM', $datas->NORM)->whereDate('TANGGAL', Carbon::today())->first();
            if ($pendaftaran) {
                $tujuan = Tujuan::where('NOPEN',$pendaftaran->NOMOR)->first();
                $ruang = Ruang::where('ID',$tujuan->RUANGAN)->first();
                $data['pasien'][$nom]["poli"] = $ruang->DESKRIPSI;
            }
            else {
                $data['pasien'][$nom]["poli"] = "";
            }


            $data['pasien'][$nom]['nomor'] = $count;
            $count++;
            $nom++;
        }
    }
    else {
        $data['pasien'] = $data['pendaftaran'];
     }
		return response()->json([
            'cari' => $data
		]);
    }

    public function cariTracerData(Request $request)
    {
        // $input = $request->cari;
        // $data = regPeriksa::where('no_rkm_medis', 'like', '%' . $input . '%')->orderBy("tgl_registrasi", "DESC")->with(['data','poli','dokter'])->get();
        // $count = 1;
        // foreach ($data as $datas) {
        //     $datas['nomor'] = $count;
        //     $count++;
        // }
        // return response()->json([
        //     'cari' => $data
        // ]);

        $input = $request->cari;
        $data = Data::where('NORM', 'like', '%' . $input . '%')->first();


        $norm = $data->NORM;
        $length = strlen($norm);
        for ($i=$length; $i < 6; $i++) {
                $norm = "0" . $norm;
        }
        $parts = str_split($norm, $split_length = 2);
        $norm = $parts[0].".".$parts[1].".".$parts[2];
        $data['NORMTITIK'] = $norm;


        $data['TANGGAL_LAHIR'] = date("d/m/Y", strtotime($data['TANGGAL_LAHIR']));
        return response()->json([
            'cari' => $data
		]);
    }

    public function label($id)
    {
        //
        // $data = Data::where('NORM', 'like', '%' . $id . '%')->first();
        // dd($data);


    }

    public function pasienData($id)
    {
        $tujuan = Tujuan::where('RUANGAN',$id)->orderBy("NOPEN", "DESC")->get();
        $dokter_ruangan = DokterRuangan::where('RUANGAN',$id)->get();
        foreach ($dokter_ruangan as $dokter_ruangans) {
            $cek = Dokter::where('ID',$dokter_ruangans['DOKTER'])->first();
            if ($cek['STATUS'] === 1) {
                $dokter[] = Dokter::where('ID',$dokter_ruangans['DOKTER'])->first();
            }
        }
        $dokterCount = 0;
        foreach ($dokter as $docter) {

            $today = $pendaftarans = Pendaftaran::whereDate('TANGGAL', Carbon::now()->today())->orderBy("TANGGAL", "DESC")->get();
            foreach ($today as $todays) {
                $cek = Tujuan::where('DOKTER',$docter['ID'])->where('NOPEN',$todays['NOMOR'])->first();
                if ($cek) {
                    $tujuan_dokter[$dokterCount][] = $cek;
                }
            }
            // $tujuan_dokter[$docter['ID']] = Tujuan::where('DOKTER',$docter['ID'])->get();
            $namaa = Pegawai::where('NIP',$docter['NIP'])->first();
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
                    $pendaftarans = Pendaftaran::whereDate('TANGGAL', Carbon::now()->today())->whereIn('STATUS',[1,2])->where('NOMOR', $namaDokter['NOPEN'])->first();
                    if (!$pendaftarans) {
                        $namaDokter['NORM'] = "";
                        $namaDokter['NAMA'] = "";
                        $namaDokter['JENIS_KELAMIN'] = "";
                        $namaDokter['TANGGAL_LAHIR'] = "";
                        $namaDokter['nomor'] = $offset;
                        $offset--;
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
                    }
                }
            }
            $dokterCount++;
        }
        // dd($tujuan_dokter);
        // foreach ($tujuan as $tujuans) {
        //     $cek = Pendaftaran::whereDate('TANGGAL', Carbon::today())->where('NOMOR', $tujuans['NOPEN'])->first();
        //     if ($cek) {
        //         $pendaftaran[] = $cek;
        //     }
        // }
        // foreach ($pendaftaran as $pendaftarans) {
        //     $data['pasien'][] = Data::where('NORM', $pendaftarans['NORM'])->get();
        //     $tujuan_hari_ini[] = Tujuan::where('NOPEN',$pendaftarans['NOMOR'])->get();
        // }
        // $count = count($data['pasien']);
        // $nom = 0;

        // // krsort($data['pasien']);

        // foreach ($data['pasien'] as $datas) {
        //     $norm = $datas[$nom]['NORM'];
        //     $length = strlen($norm);
        //     for ($i=$length; $i < 6; $i++) {
        //             $norm = "0" . $norm;
        //     }
        //     $parts = str_split($norm, $split_length = 2);
        //     $norm = $parts[0].".".$parts[1].".".$parts[2];
        //     $lahir = date("d/m/Y", strtotime($datas[$nom]['TANGGAL_LAHIR']));
        //     $norm = $datas[$nom]['NORMTITIK'] = $norm;

        //     $datas[0]['TANGGAL_LAHIR'] = date("d/m/Y", strtotime($datas[0]['TANGGAL_LAHIR']));

        //     $datas[$nom]['nomor'] = $count;
        //     $count--;
        // }

		return response()->json([
            'cari' => $tujuan_dokter
		]);
    }

    public function pasienDataUGD(Request $request)
    {
        $tujuan = Tujuan::where('RUANGAN','101020101')->orderBy("NOPEN", "DESC")->get();
        $dokter_ruangan = DokterRuangan::where('RUANGAN','101020101')->get();
        foreach ($dokter_ruangan as $dokter_ruangans) {
            $dokter[] = Dokter::where('ID',$dokter_ruangans['DOKTER'])->get();
        }
        foreach ($tujuan as $tujuans) {
            $cek = Pendaftaran::whereDate('TANGGAL', Carbon::now()->today())->where('NOMOR', $tujuans['NOPEN'])->first();
            if ($cek) {
                $pendaftaran[] = $cek;
            }
        }
        // dd($pendaftaran);
        foreach ($pendaftaran as $pendaftarans) {
            $data['pasien'][] = Data::where('NORM', $pendaftarans['NORM'])->get();
            $tujuan_hari_ini[] = Tujuan::where('NOPEN',$pendaftarans['NOMOR'])->get();
        }
        $count = count($data['pasien']);
        $nom = 0;
        // dd($data['pasien']);
            foreach ($data['pasien'] as $datas) {
                $norm = $datas[$nom]['NORM'];
                $length = strlen($norm);
                for ($i=$length; $i < 6; $i++) {
                        $norm = "0" . $norm;
                }
                $parts = str_split($norm, $split_length = 2);
                $norm = $parts[0].".".$parts[1].".".$parts[2];
                $lahir = date("d/m/Y", strtotime($datas[$nom]['TANGGAL_LAHIR']));
                $norm = $datas[$nom]['NORMTITIK'] = $norm;

                $datas[0]['TANGGAL_LAHIR'] = date("d/m/Y", strtotime($datas[0]['TANGGAL_LAHIR']));

                $datas[$nom]['nomor'] = $count;
                $count--;
            }
		return response()->json([
            'cari' => $data['pasien']
		]);


    }



    public function test()

    {
        $tracer = Pasien::all();
        dd($tracer);
    }



    public function BACKUPpasienData()
    {
        $tujuan = Tujuan::where('RUANGAN','101020101')->orderBy("NOPEN", "DESC")->get();
        $dokter_ruangan = DokterRuangan::where('RUANGAN','101020101')->get();
        foreach ($dokter_ruangan as $dokter_ruangans) {
            $dokter[] = Dokter::where('ID',$dokter_ruangans['DOKTER'])->get();
        }
        foreach ($tujuan as $tujuans) {
            $cek = Pendaftaran::whereDate('TANGGAL', Carbon::today())->where('NOMOR', $tujuans['NOPEN'])->first();
            if ($cek) {
                $pendaftaran[] = $cek;
            }
        }
        foreach ($pendaftaran as $pendaftarans) {
            $data['pasien'][] = Data::where('NORM', $pendaftarans['NORM'])->get();
            $tujuan_hari_ini[] = Tujuan::where('NOPEN',$pendaftarans['NOMOR'])->get();
        }
        $count = count($data['pasien']);
        $nom = 0;

        // krsort($data['pasien']);

        foreach ($data['pasien'] as $datas) {
            $norm = $datas[$nom]['NORM'];
            $length = strlen($norm);
            for ($i=$length; $i < 6; $i++) {
                    $norm = "0" . $norm;
            }
            $parts = str_split($norm, $split_length = 2);
            $norm = $parts[0].".".$parts[1].".".$parts[2];
            $lahir = date("d/m/Y", strtotime($datas[$nom]['TANGGAL_LAHIR']));
            $norm = $datas[$nom]['NORMTITIK'] = $norm;

            $datas[0]['TANGGAL_LAHIR'] = date("d/m/Y", strtotime($datas[0]['TANGGAL_LAHIR']));

            $datas[$nom]['nomor'] = $count;
            $count--;
        }

		return response()->json([
            'cari' => $data
		]);
    }
}
