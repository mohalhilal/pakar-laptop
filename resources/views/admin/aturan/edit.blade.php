@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Aturan</h1>
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
    <form action="{{ route('aturan.update') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $aturan->id }}">
        <div class="mb-3">
            <label for="id_kerusakan" class="form-label">Kerusakan</label>
            <select name="kode_kerusakan" id="id_kerusakan" class="form-select" required>
                <option value="">Pilih Kerusakan</option>
                @foreach ($kerusakan as $item)
                <option value="{{ $item->kode }}" {{ $item->kode == $aturan->kode_kerusakan ? 'selected' : '' }}>
                    {{ $item->nama_kerusakan }} - {{ $item->kode }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_kerusakan" class="form-label">Gejala</label>
            <select name="kode_gejala" id="id_kerusakan" class="form-select" required>
                <option value="">Pilih Gajala</option>
                @foreach ($gejala as $item2)
                <option value="{{ $item2->kode }}" {{ $item2->kode == $aturan->kode_gejala ? 'selected' : '' }}>
                    {{ $item2->nama_gejala }} - {{ $item2->kode }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="solusi" class="form-label">Nilai MB</label>
            <input type="number" name="cf_pakar" step="0.1" max="1" class="form-control" required value="{{ $aturan->cf_pakar }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('aturan') }}" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection