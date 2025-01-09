@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Data Aturan</h2>

    <!-- Tabel Data Aturan -->
    <div class="table-responsive">
        <table class="table table-responsive table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th width="15%">Gejala | Kerusakan --> </th>
                    @foreach($kerusakan as $kr)
                    <th>{{ $kr->kode }}</th>
                    @endforeach


                </tr>
            </thead>
            <tbody>
                @foreach($gejala as $gjl)
                <tr>
                    <td>{{ $gjl->kode }}</td>
                    @foreach($kerusakan as $k)
                    <?php $atr = \App\Models\Aturan::where('kode_kerusakan', $k->kode)->where('kode_gejala', $gjl->kode)->first(); ?>
                    @if(!empty($atr))
                    <td>✅</td>
                    @else
                    <td>❌</td>
                    @endif
                    @endforeach
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <b>Keterangan : Kerusakan</b>
            <ul>
                @foreach($kerusakan as $row)
                <li>( {{ $row->kode }} ) - {{ $row->nama_kerusakan }}</li>
                @endforeach

            </ul>
        </div>
        <div class="col-md-4">
            <b>Keterangan : Gejala</b>
            <ul>
                @foreach($gejala as $row)
                <li>( {{ $row->kode }} ) - {{ $row->nama_gejala }}</li>
                @endforeach

            </ul>
        </div>
    </div>
</div>
@endsection