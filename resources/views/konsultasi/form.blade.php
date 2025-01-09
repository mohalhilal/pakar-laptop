@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h1>Formulir Konsultasi</h1>
    <br>
    @if (!empty(session('gagal')))
    <div class="alert alert-danger">
        <ul>
            <li>{{ session('gagal') }}</li>
        </ul>
    </div>
    @endif
    <br>
    <form action="{{ route('konsultasi.process') }}" method="POST">
        @csrf
        <table class="table table table-responsive table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Kode</th>
                    <th>Gejala</th>
                    <th>Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gejala as $item)
                <tr>
                    <td>{{ $item->kode }}</td>
                    <td>Apakah {{ $item->nama_gejala }} ?</td>
                    <td width="200px" class="text-center">
                        <div class="mb-0">
                            <select name="jawaban[{{ $item->kode }}]" id="id_kerusakan" class="form-select">
                                <option value="">Tidak</option>
                                <option value="0.2">Kurang Yakin</option>
                                <option value="0.4">Cukup Yakin</option>
                                <option value="0.8">Yakin</option>
                                <option value="1">Sangat Yakin</option>
                            </select>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3">Proses Diagnosa >></button>
            <a href="{{ route('konsultasi') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>

    </form>
</div>
@endsection