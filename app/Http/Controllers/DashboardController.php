<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPegawai = Pegawai::count();
        $totalPNS = Pegawai::where('status_kepegawaian', 'PNS')->count();
        $totalPPPK = Pegawai::where('status_kepegawaian', 'PPPK')->count();
        $totalTempatTugas = Pegawai::select('tempat_tugas')->distinct()->count();

        // Pie chart data
        $statusCounts = Pegawai::selectRaw('status_kepegawaian, COUNT(*) as jumlah')
            ->groupBy('status_kepegawaian')
            ->pluck('jumlah', 'status_kepegawaian')
            ->toArray();

        // Bar chart data
        $tugasCounts = Pegawai::selectRaw('tempat_tugas, COUNT(*) as jumlah')
            ->groupBy('tempat_tugas')
            ->pluck('jumlah', 'tempat_tugas')
            ->toArray();

        return view('dashboard', compact(
            'totalPegawai',
            'totalPNS',
            'totalPPPK',
            'totalTempatTugas',
            'statusCounts',
            'tugasCounts'
        ));
    }
}