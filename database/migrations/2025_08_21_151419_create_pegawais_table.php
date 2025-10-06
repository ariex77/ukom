<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nip')->unique();
            $table->string('pangkat');
            $table->string('golongan');
            $table->string('jabatan');
            $table->integer('masa_kerja_tahun');
            $table->integer('masa_kerja_bulan');
            $table->enum('status_kepegawaian', ['PNS', 'PPPK']);
            $table->string('nama_sekolah');
            $table->year('tahun_lulus');
            $table->string('tingkat_pendidikan');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->integer('usia');
            $table->string('tempat_tugas');
            $table->string('nomor_seri_karpeg');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}