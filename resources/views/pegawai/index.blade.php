@extends('layouts.app')

@section('content')
<style>
    .table-smaller th, .table-smaller td {
        font-size: 12px !important;
        vertical-align: middle !important;
    }
    .table-smaller th {
        text-align: center !important;
    }
    .table-smaller td {
        text-align: left !important;
    }
    .col-karpeg {
        width: 60px;
        max-width: 60px;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .pagination {
        font-size: 14px;
    }
    .pagination .page-link {
        padding: 4px 8px;
        font-size: 13px;
    }
    .ttd-kepala {
        margin-top: 48px;
        width: 100%;
    }
    .ttd-kepala td {
        border: none !important;
        text-align: right;
        padding-right: 80px;
        padding-top: 32px;
    }
    .nama-kepala {
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: 0;
    }
    .nip {
        margin-top: 0;
    }
</style>

<div class="container-fluid p-0">

    {{-- Filter --}}
    <form method="GET" action="{{ route('pegawais.index') }}" class="row g-2 mb-3">
        <div class="col-md-3">
            <input type="text" name="q" class="form-control" placeholder="Cari nama, NIP, jabatan..." value="{{ request('q') }}">
        </div>
        @php
            $golonganList = ['IIa','IIb','IIc','IId','IIIa','IIIb','IIIc','IIId','IVa','IVb','IVc','IVd','IVe'];
        @endphp
        <div class="col-md-2">
            <select name="golongan" class="form-select">
                <option value="">Semua Golongan</option>
                @foreach($golonganList as $gol)
                    <option value="{{ $gol }}" {{ request('golongan') == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="pendidikan" class="form-select">
                <option value="">Semua Pendidikan</option>
                @foreach(['SD','SLTP','SLTA','D1','D2','D3','S1','S2','S3'] as $pend)
                    <option value="{{ $pend }}" {{ request('pendidikan') == $pend ? 'selected' : '' }}>{{ $pend }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="tugas" class="form-select">
                <option value="">Semua Tempat Tugas</option>
                @foreach($tempatTugasList as $tugas)
                    <option value="{{ $tugas }}" {{ request('tugas') == $tugas ? 'selected' : '' }}>{{ $tugas }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Filter</button>
        </div>
        <div class="col-md-1">
            <a href="{{ route('pegawais.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-smaller w-100">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama & TTL</th>
                    <th>NIP</th>
                    <th>Pangkat / Golongan</th>
                    <th>Jabatan</th>
                    <th>Masa Kerja</th>
                    <th>Status</th>
                    <th>Sekolah</th>
                    <th>Lulus</th>
                    <th>Pendidikan</th>
                    <th>JK</th>
                    <th>Usia</th>
                    <th>Tempat Tugas</th>
                    <th>Karpeg</th>
                    <th>SK Pangkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pegawais as $no => $pegawai)
                <tr>
                    <td>{{ ($pegawais->currentPage() - 1) * $pegawais->perPage() + $no + 1 }}</td>
                    <td>{{ $pegawai->nama }}<br>{{ $pegawai->tempat_lahir }}, {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $pegawai->nip }}</td>
                    <td>{{ $pegawai->pangkat }} / {{ $pegawai->golongan }}</td>
                    <td>{{ $pegawai->jabatan }}</td>
                    <td>{{ $pegawai->masa_kerja_tahun }} th {{ $pegawai->masa_kerja_bulan }} bln</td>
                    <td>{{ $pegawai->status_kepegawaian }}</td>
                    <td>{{ $pegawai->nama_sekolah }}</td>
                    <td>{{ $pegawai->tahun_lulus }}</td>
                    <td>{{ $pegawai->tingkat_pendidikan }}</td>
                    <td>{{ $pegawai->jenis_kelamin }}</td>
                    <td>{{ $pegawai->usia }}</td>
                    <td>{{ $pegawai->tempat_tugas }}</td>
                    <td class="col-karpeg">{{ $pegawai->nomor_seri_karpeg }}</td>
                    <td>
                        @if($pegawai->sk_pangkat_terakhir)
                            <a href="{{ asset('storage/' . $pegawai->sk_pangkat_terakhir) }}" target="_blank" class="btn btn-sm btn-success">
                                <i class="bi bi-file-earmark-text"></i> SK Pangkat
                            </a>
                        @else
                            <span class="text-muted">Belum diupload</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('pegawais.edit', $pegawai->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('pegawais.destroy', $pegawai->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-2 text-center">
        <small>Menampilkan {{ $pegawais->firstItem() }} - {{ $pegawais->lastItem() }} dari total {{ $pegawais->total() }} pegawai</small>
        <div class="mt-2">
            {{ $pegawais->links() }}
        </div>
    </div>

    {{-- Tanda Tangan --}}
    @if($pegawais->currentPage() == $pegawais->lastPage())
    <table class="ttd-kepala">
        <tr>
            <td>
                Bangkinang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                Kepala Dinas Kesehatan<br><br><br><br>
                <div class="nama-kepala">dr. ASMARA FITRAH ABADI</div>
                <div>Pembina Utama Muda (IVc)</div>
                <div class="nip">NIP. 19720911 200312 1 007</div>
            </td>
        </tr>
    </table>
    @endif
</div>
@endsection
