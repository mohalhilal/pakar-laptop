<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Konsultasi</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            font-size: 10pt;
            line-height: normal;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            /* Vertikal rata tengah */
            justify-content: space-between;
            /* Beri jarak di antara elemen */
            margin-bottom: 20px;
        }

        .kop-surat .logo {
            width: 80px;
            /* Ukuran logo */
            height: 80px;
        }

        .kop-surat .info {
            text-align: center;
            flex: 1;
            /* Isi ruang di antara elemen */
        }

        .kop-surat .info h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .kop-surat .info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .garis {
            border: 1px solid black;
            margin: 10px 0;
        }

        .header {
            position: relative;
            margin-bottom: 45px;
        }

        .header .id-konsultasi {
            position: absolute;
            left: 0;
            top: 0;
        }

        .header .tanggal {
            position: absolute;
            right: 0;
            top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            background-color: #FFD700;
            /* Warna kuning */
            color: black;
            text-align: left;
            padding: 5px;
        }

        td {
            padding: 5px;
        }

        h2,
        h3 {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <img src="{{ $base64 }}" alt="Logo Multinet Compindo" class="logo" style="position: absolute;">
        <div class="info">
            <h1>Multinet Compindo</h1>
            <p>Jl. Panjunan, Panjunan, Kec. Lemahwungkuk, Kota Cirebon, Jawa Barat</p>
            <p>Email: multinet_crb@yahoo.co.id | Telepon: 0853-2122-2686</p>
        </div>
    </div>
    <div class="garis"></div>
    <h2 style="text-align: center;">Hasil Konsultasi</h2>
    <!-- Header -->
    <div class="header">
        <p class="id-konsultasi"><strong>ID Konsultasi:</strong> {{ $konsultasi->id }}</p>
        <p class="tanggal">{{ $konsultasi->created_at->format('d-m-Y H:i') }}</p>
    </div>


    <p style="margin: 5px 0px;">Nama : {{ $konsultasi->user->name }}</p>
    <p style="margin: 5px 0px;">Email : {{ $konsultasi->user->email }}</p>

    <!-- Gejala yang Dipilih -->
    <h3>Gejala yang Dipilih</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Gejala</th>
                <th>Nilai Keyakinan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($konsultasi->jawaban as $index => $jawaban)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $jawaban->gejala->nama_gejala }}</td>
                <td>{{ $jawaban->cf_user }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Kerusakan yang Relevan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kerusakan</th>
                <th>Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($konsultasi->hasil as $index => $hasil)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $hasil->kerusakan->nama_kerusakan }}</td>
                <td>{{ number_format($hasil->persentase, 2) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Kesimpulan -->
    <h3>Kesimpulan</h3>
    <p>Kerusakan yang paling mungkin berdasarkan gejala yang dipilih adalah:</p>
    <p style="color: red;"><strong>{{ $konsultasi->kerusakan->nama_kerusakan}}</strong></p>
    <p>Persentase Keyakinan:<strong> {{ number_format($konsultasi->persentase, 2) }}%</strong> </p>


    <!-- Solusi -->
    <h3>Solusi</h3>
    <ul>
        @foreach($konsultasi->kerusakan->solusi->where('kode_kerusakan',$konsultasi->kode_kerusakan)->get() as $solusi)
        <li>{{ $solusi->solusi }}</li>
        @endforeach
    </ul>
</body>

</html>