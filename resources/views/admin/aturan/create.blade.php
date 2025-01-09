@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Aturan</h1>
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
    <form action="{{ route('aturan.store') }}" method="POST">
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
            <label for="id_kerusakan" class="form-label">Gejala</label>
            <select name="kode_gejala" id="id_kerusakan" class="form-select" required>
                <option value="">Pilih Gejala</option>
                @foreach ($gejala as $item2)
                <option value="{{ $item2->kode }}">{{ $item2->nama_gejala }} - ({{ $item2->kode }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="solusi" class="form-label">Nilai CF</label>
            <input type="number" name="cf_pakar" step="0.1" max="1" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('aturan') }}" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection