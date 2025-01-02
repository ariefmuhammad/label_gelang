<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pendaftaran;
use App\Kunjungan;
use App\Pasien;
use App\Ruang;
use App\TujuanPasien;
use App\Penjamin;
use App\KartuAsuransiPasien;
use App\Peserta;


class PasienController extends Controller
{
    public function pasien() {

    $pendaftaran = Pendaftaran::query()->whereDate('TANGGAL', '>=', '2024-04-01')->whereDate('TANGGAL', '<=', '2024-10-31')->get();
    $penjamin = Penjamin::where('KELAS', 3)->first(); 

    $data['101010101'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010101)
    ->select('pendaftaran.pendaftaran.NOMOR', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010102'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010102)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010103'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010103)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010104'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010104)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010105'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010105)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010106'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010106)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010107'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010107)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010108'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010108)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010109'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010109)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010110'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010110)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010111'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010111)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010112'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010112)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010113'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010113)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010114'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010114)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010115'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010115)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010116'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010116)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010117'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010117)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010118'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010118)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();

    $data['101010119'] = Pendaftaran::join('pendaftaran.penjamin', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.penjamin.NOPEN')
    ->join('pendaftaran.tujuan_pasien', 'pendaftaran.pendaftaran.NOMOR', '=', 'pendaftaran.tujuan_pasien.NOPEN')
    ->join('master.ruangan', 'pendaftaran.tujuan_pasien.RUANGAN', '=', 'master.ruangan.ID')
    ->whereDate('pendaftaran.pendaftaran.TANGGAL', '>=', '2024-04-01')->whereDate('pendaftaran.pendaftaran.TANGGAL', '<=', '2024-10-31')
    ->where('pendaftaran.penjamin.KELAS', 3)
    // ->whereIn('pendaftaran.tujuan_pasien.ruangan', [101010101, 101010102, 101010103, 101010104, 101010105, 101010106, 101010107, 101010108, 101010109, 101010110, 101010111, 101010112, 101010113, 101010114, 101010115, 101010116, 101010117, 101010118, 101010119])
    ->where('pendaftaran.tujuan_pasien.RUANGAN', 101010119)
    ->select('pendaftaran.tujuan_pasien.RUANGAN', 'pendaftaran.penjamin.KELAS', 'master.ruangan.DESKRIPSI', \DB::raw('COUNT(pendaftaran.tujuan_pasien.RUANGAN) AS TOTAL'))
    ->first();



  

 
    
            

    $pasien = Pasien::first();
    $kap = KartuAsuransiPasien::first();
    $bpjspaserta = Peserta::first();
    $tp = TujuanPasien::first();
    $ruangan = Ruang::get();


    return response()->json([
      'hasil' => $data
    ]); 
  }
}
