@extends(Auth::user()->role === "admin" ? 'admin.layouts.app' : 'layouts.app')

@section('content')

<div class="container mt-5">
    <h2 class="text-center mb-4">Hasil Diagnosa</h2>
    <div class="card">
        <div class="card-body">
            <!-- Informasi User -->
            <h5 class="card-title">Informasi Pengguna</h5>
            <table class="table table-bordered">
                <tr>
                    <th width="25%">Nama</th>
                    <td>{{ $konsultasi->user->name  }}</td>
                </tr>
                <tr>
                    <th width="25%">Email</th>
                    <td>{{ $konsultasi->user->email }}</td>
                </tr>
            </table>

            <!-- Data Jawaban -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4>Data Gejala dan Keyakinan</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($konsultasi->jawaban as $jawaban)
                        <li class="list-group-item">{{$jawaban->gejala->nama_gejala}}<span class="badge bg-info float-end">Nilai CF : {{ $jawaban->cf_user }}</span></li>
                        @endforeach
                        <!-- Tambahkan data jawaban lainnya -->
                    </ul>
                </div>
            </div>

            <!-- Data Kerusakan -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h4>Data Kerusakan Berdasarkan Gejala</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Kerusakan</th>
                                <th>Persentase Kerusakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($konsultasi->hasil as $hasil)
                            <tr>
                                <td>{{$hasil->kerusakan->nama_kerusakan}}</td>
                                <td>{{ $hasil->persentase }}%</td>
                            </tr>
                            @endforeach
                            <!-- Tambahkan kerusakan lainnya -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kesimpulan -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h4>Kesimpulan Kerusakan</h4>
                </div>
                <div class="card-body">
                    <p><strong>{{ $konsultasi->kerusakan->nama_kerusakan }}</strong> dengan persentase kerusakan <strong>{{ $konsultasi->persentase }}%</strong></p>
                </div>
            </div>

            <!-- Solusi -->
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h4>Solusi Kerusakan</h4>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($konsultasi->kerusakan->solusi->where('kode_kerusakan',$konsultasi->kode_kerusakan)->get() as $solusi)
                        <li>{{ $solusi->solusi }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-4">
        @if(!empty(Auth::user()) && Auth::user()->role === "admin")
        <a href="{{ route('kelola-konsultasi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        @else
        <a href="{{ route('konsultasi') }}" class="btn btn-secondary mt-3">Kembali</a>
        @endif
        <a href="{{ route('konsultasi.downloadPDF', $konsultasi->id) }}" class="btn btn-primary mt-3">Donwload Hasil</a>
        <br>
        <br>
    </div>
</div>
@endsection