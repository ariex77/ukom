@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Pegawai</h2>

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

    {{-- Form tambah pegawai --}}
    <form action="{{ route('pegawais.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('pegawai.form')

        <div class="mb-3">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-save"></i> Simpan
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
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
</div>
@endsection
