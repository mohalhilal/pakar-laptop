@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Gejala</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('gejala.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_gejala" class="form-label">Nama Gejala</label>
            <input type="text" name="nama_gejala" id="nama_gejala" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('gejala.index') }}" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection