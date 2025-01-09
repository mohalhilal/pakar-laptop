@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Solusi</h1>
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
    <form action="{{ route('solusi.update', $solusi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_kerusakan" class="form-label">Kerusakan</label>
            <select name="kode_kerusakan" id="id_kerusakan" class="form-select" required>
                <option value="">Pilih Kerusakan</option>
                @foreach ($kerusakan as $item)
                <option value="{{ $item->kode }}" {{ $item->kode == $solusi->kode_kerusakan ? 'selected' : '' }}>
                    {{ $item->nama_kerusakan }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="solusi" class="form-label">Solusi</label>
            <textarea name="solusi" id="solusi" class="form-control" required>{{ $solusi->solusi }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('solusi.index') }}" class="btn btn-warning">Kembali</a>
    </form>
</div>
@endsection