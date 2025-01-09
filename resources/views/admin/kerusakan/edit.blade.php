@extends('admin.layouts.app')

@section('content')
<div class="container">

    <h1>Edit Kerusakan</h1>
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
    <form action="{{ route('kerusakan.update', $kerusakan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode" class="form-label">Kode Kerusakan</label>
            <input type="text" name="kode" id="kode" class="form-control" value="{{ $kerusakan->kode }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_kerusakan" class="form-label">Nama Kerusakan</label>
            <input type="text" name="nama_kerusakan" id="nama_kerusakan" class="form-control" value="{{ $kerusakan->nama_kerusakan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kerusakan.index') }}" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection