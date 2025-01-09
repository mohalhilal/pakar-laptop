@extends('admin.layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h1>Tambah Kerusakan</h1>

    <form action="{{ route('kerusakan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_kerusakan" class="form-label">Nama Kerusakan</label>
            <input type="text" name="nama_kerusakan" id="nama_kerusakan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kerusakan.index') }}" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection