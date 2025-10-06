<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'nip',
        'pangkat',
        'golongan',
        'jabatan',
        'masa_kerja_tahun',
        'masa_kerja_bulan',
        'status_kepegawaian',
        'nama_sekolah',
        'tahun_lulus',
        'tingkat_pendidikan',
        'jenis_kelamin',
        'usia',
        'tempat_tugas',
        'nomor_seri_karpeg',
        'sk_pangkat_terakhir',
        'user_id',
    ];
    public function scopeSorted($query)
    {
        $pendidikanOrder = "FIELD(tingkat_pendidikan, 'S3','S2','S1','D4','D3','D2','D1','SLTA','SLTP','SD')";
        $pangkatOrder = "FIELD(pangkat, 
            'Pembina Utama',
            'Pembina Utama Madya',
            'Pembina Utama Muda',
            'Pembina Tingkat I',
            'Pembina',
            'Penata Tingkat I',
            'Penata',
            'Penata Muda Tingkat I',
            'Penata Muda',
            'Pengatur Tingkat I',
            'Pengatur',
            'Pengatur Muda Tingkat I',
            'Pengatur Muda',
            'PPPK'
        )";

        return $query->orderByRaw($pangkatOrder)
            ->orderByDesc('golongan')
            ->orderByRaw('(masa_kerja_tahun * 12 + masa_kerja_bulan) DESC')
            ->orderByRaw($pendidikanOrder)
            ->orderByDesc('usia');
    }

}
