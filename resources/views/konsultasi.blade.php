@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:70px; min-height:100vh;">
    <form action="{{ route('konsultasi.form') }}" method="get">
        <button class="btn btn-primary btn-lg">
            Buat Konsultasi Baru 🕵️‍♀️
        </button>
    </form>

    <br>
    <br>
    <h3>Riwayat Konsultasi</h3>
    <br>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- Tabel Daftar User -->
            <div class="table-responsive" id="userTable">
                <table id="tabel" class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Hasil Diagnosa</th>
                            <th>Persentase Kerusakan</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1 ?>
                        @foreach($konsultasi as $item)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>
                                @if($item->kode_kerusakan === NULL)
                                <h5><span class="badge bg-danger">{{ "Tidak ditemukan kerusakan"}}</span></h5>
                                @else
                                <h5><span class="badge bg-success">{{ $item->kerusakan->nama_kerusakan }}</span></h5>
                                @endif
                            </td>
                            <td>{{ $item->persentase }}%</td>
                            <td>{{ $item->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{ route('konsultasi.hasil', $item->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                                <form action="{{ route('konsultasi.hapus', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <!-- Contoh data statis -->
                        <!-- Tambahkan data dinamis di sini -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    let table = new DataTable('#tabel');
</script>

@endsection