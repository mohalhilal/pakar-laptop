@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Gejala</h5>
                    <p class="card-text display-4">{{ $jumlahGejala }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Kerusakan</h5>
                    <p class="card-text display-4">{{ $jumlahKerusakan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Customer</h5>
                    <p class="card-text display-4">{{ $jumlahUser }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Konsultasi</h5>
                    <p class="card-text display-4">{{ $jumlahKonsul }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Konsultasi Terbaru -->
    <div class="card">
        <div class="card-header position-relative">
            Konsultasi Terbaru
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama User</th>
                        <th>Hasil Konsultasi</th>
                        <th>Waktu Konsultasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($konsultasiTerbaru as $konsul)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $konsul->user->name}}</td>
                        @if($konsul->kode_kerusakan === NULL)
                        <td>Tidak ditemukan hasil</td>
                        @else
                        <td>{{ $konsul->kerusakan->nama_kerusakan}}</td>
                        @endif

                        <td>{{ $konsul->created_at->diffForHumans()}}</td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection