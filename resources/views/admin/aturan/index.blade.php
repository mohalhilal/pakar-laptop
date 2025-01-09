@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Aturan</h1>
    <br>

    <div class="mb-3">
        <a href="{{ route('aturan.create') }}" class="btn btn-primary mb-3">Tambah Aturan</a>
        <br>
        <!-- Export -->
        <a href="{{ route('aturan.export') }}" class="btn btn-success">Export Data Aturan</a>
        <br>
        <br>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('aturan.import') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                    @csrf
                    <input type="file" name="file" class="form-control-file d-inline" required>
                    <button type="submit" class="btn btn-primary">Import Data Aturan</button>
                </form>
            </div>
        </div>
        <!-- Import -->
        <br>
        <!-- Tombol Kosongkan Data -->
        <button class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#clearModal">
            Kosongkan Semua Data
        </button>

        <!-- Modal Konfirmasi Kosongkan -->
        <div class="modal fade" id="clearModal" tabindex="-1" aria-labelledby="clearModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('aturan.clear') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="clearModalLabel">Konfirmasi Penghapusan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus semua data gejala? Tindakan ini tidak dapat dibatalkan.</p>
                            <div class="mb-3">
                                <label for="password" class="form-label">Masukkan Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus Semua</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

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

    <table id="tabel" class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Kerusakan</th>
                <th>Nama Kerusakan</th>
                <th>Kode Gejala</th>
                <th>Nama Gejala</th>
                <th>Nilai CF</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aturan as $item)
            <tr>
                <td>{{ $item->kode_kerusakan }}</td>
                <td>{{ $item->kerusakan->nama_kerusakan }}</td>
                <td>{{ $item->kode_gejala }}</td>
                <td>{{ $item->gejala->nama_gejala }}</td>
                <td>{{ $item->cf_pakar }}</td>
                <td>
                    <a href="{{ route('aturan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('aturan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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