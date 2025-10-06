@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Pegawai</h2>

    {{-- Feedback sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validasi error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form edit pegawai --}}
    <form method="POST" action="{{ route('pegawais.update', $pegawai->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('pegawai.form', ['pegawai' => $pegawai])

        {{-- Preview Sertifikat UKOM --}}
        @if($pegawai->sertifikat_ukom)
            <div class="mb-3">
                <label>Sertifikat UKOM Saat Ini:</label><br>
                <a href="{{ asset('storage/' . $pegawai->sertifikat_ukom) }}" target="_blank" class="btn btn-sm btn-outline-info">
                    <i class="bi bi-file-earmark-text"></i> Lihat Sertifikat
                </a>
            </div>
        @endif

        {{-- Preview SK Pangkat Terakhir --}}
        @if($pegawai->sk_pangkat_terakhir)
            <div class="mb-3">
                <label>SK Pangkat Terakhir Saat Ini:</label><br>
                <a href="{{ asset('storage/' . $pegawai->sk_pangkat_terakhir) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                    <i class="bi bi-file-earmark-text"></i> Lihat SK Pangkat
                </a>
            </div>
        @endif

        <div class="mb-3">
            <button class="btn btn-success" type="submit">
                <i class="bi bi-save"></i> Update
            </button>
            <a href="{{ route('pegawais.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </form>

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pegawais.index') }}">Data Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
</div>
@endsection
