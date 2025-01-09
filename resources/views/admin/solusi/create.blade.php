@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Solusi</h1>
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
    <form action="{{ route('solusi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_kerusakan" class="form-label">Kerusakan</label>
            <select name="kode_kerusakan" id="id_kerusakan" class="form-select" required>
                <option value="">Pilih Kerusakan</option>
                @foreach ($kerusakan as $item)
                <option value="{{ $item->kode }}">{{ $item->nama_kerusakan }} - ({{ $item->kode }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="solusi" class="form-label">Solusi</label>
            <textarea name="solusi" id="solusi" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('solusi.index') }}" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection