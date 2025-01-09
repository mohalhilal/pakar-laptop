@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Gejala</h1>
    <br>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('gejala.update', $gejala->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode" class="form-label">Kode Gejala</label>
            <input type="text" name="kode" id="kode" class="form-control" value="{{ $gejala->kode }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_gejala" class="form-label">Nama Gejala</label>
            <input type="text" name="nama_gejala" id="nama_gejala" class="form-control" value="{{ $gejala->nama_gejala }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('gejala.index') }}" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection