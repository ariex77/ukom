<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PegawaiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pegawai::all();
    }
    public function headings(): array
    {
        return [
            'ID','Nama','Tempat Lahir','Tanggal Lahir','NIP','Pangkat',
            'Golongan','Jabatan','Masa Kerja Tahun','Masa Kerja Bulan','Status Kepegawaian',
            'Nama Sekolah','Tahun Lulus','Tingkat Pendidikan','Jenis Kelamin','Usia',
            'Tempat Tugas','Nomor Seri Karpeg','Created At','Updated At'
        ];
    }
}