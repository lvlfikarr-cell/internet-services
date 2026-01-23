<div class="mb-3">
    <label>Nama Layanan</label>
    <input type="text" name="nama_layanan" class="form-control"
        value="{{ old('nama_layanan', $jenis_layanan->nama_layanan ?? '') }}">
</div>

<div class="mb-3">
    <label>Harga</label>
    <input type="number" name="harga" class="form-control"
        value="{{ old('harga', $jenis_layanan->harga ?? '') }}">
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $jenis_layanan->deskripsi ?? '') }}</textarea>
</div>

@extends('layouts.app')
@section('content')
<h4>Tambah Jenis Layanan</h4>

<form action="{{ route('jenis-layanan.store') }}" method="POST">
@csrf
@include('jenis_layanan.form')
<button class="btn btn-primary">Simpan</button>
<a href="{{ route('jenis-layanan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection


@extends('layouts.app')
@section('content')
<h4>Edit Jenis Layanan</h4>

<form action="{{ route('jenis-layanan.update',$jenis_layanan->id) }}" method="POST">
@csrf @method('PUT')
@include('jenis_layanan.form')
<button class="btn btn-primary">Update</button>
<a href="{{ route('jenis-layanan.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
