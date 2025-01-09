@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Konsultasi</h1>
    <br>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="tabel" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Kerusakan</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($konsultasi as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->email }}</td>
                <td>
                    @if($item->kode_kerusakan === NULL)
                    <h5><span class="badge bg-danger">{{ "Tidak ditemukan kerusakan"}}</span></h5>
                    @else
                    <h5><span class="badge bg-success">{{ $item->kerusakan->nama_kerusakan }}</span></h5>
                    @endif
                </td>
                <td>{{ $item->created_at->diffForHumans()}}</td>
                <td>
                    <a href="{{ route('konsultasi.hasil', $item->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    <form action="{{ route('kelola-konsultasi.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    let table = new DataTable('#tabel');
</script>
@endsection