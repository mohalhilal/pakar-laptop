@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Kerusakan</h1>
    <br>
    <a href="{{ route('kerusakan.create') }}" class="btn btn-primary mb-3">Tambah Kerusakan</a>

    <div class="mb-3">
        <!-- Export -->
        <a href="{{ route('kerusakan.export') }}" class="btn btn-success">Export Data Kerusakan</a>
        <br>
        <br>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kerusakan.import') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                    @csrf
                    <input type="file" name="file" class="form-control-file d-inline" required>
                    <button type="submit" class="btn btn-primary">Import Data Kerusakan</button>
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
                    <form action="{{ route('kerusakan.clear') }}" method="POST">
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

    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
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
                <th width="120px">Kode</th>
                <th>Nama Kerusakan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kerusakan as $item)
            <tr>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama_kerusakan }}</td>
                <td>
                    <a href="{{ route('kerusakan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('kerusakan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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