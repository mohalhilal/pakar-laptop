@extends('layouts.app')

@section('content')
<header class="bg-secondary bg-opacity-10 py-5" style="margin-top: -25px;">
    <div class="container text-center">
        <h1 class="fw-bold">Panduan Penggunaan Aplikasi Sistem Pakar Kerusakan Laptop</h1>
        <p class="lead">Ikuti langkah-langkah berikut untuk menggunakan aplikasi dengan mudah.</p>
    </div>
</header>

<div class="container my-5">
    <div class="row gy-4">
        <!-- Step 1 -->
        <div class="col-md-4">
            <div class="card step-card h-100 text-center">
                <div class="card-body">
                    <div class="step-icon mb-3">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h5 class="card-title">1. Daftar / Masuk</h5>
                    <p class="card-text">Masukkan email dan password Anda untuk masuk. Jika belum punya akun, silakan daftar terlebih dahulu.</p>
                </div>
            </div>
        </div>
        <!-- Step 2 -->
        <div class="col-md-4">
            <div class="card step-card h-100 text-center">
                <div class="card-body">
                    <div class="step-icon mb-3">
                        <i class="bi bi-list"></i>
                    </div>
                    <h5 class="card-title">2. Menu Konsultasi</h5>
                    <p class="card-text">Pilih menu "Konsultasi" dari dashboard untuk memulai proses diagnosa kerusakan.</p>
                </div>
            </div>
        </div>
        <!-- Step 3 -->
        <div class="col-md-4">
            <div class="card step-card h-100 text-center">
                <div class="card-body">
                    <div class="step-icon mb-3">
                        <i class="bi bi-plus-circle"></i>
                    </div>
                    <h5 class="card-title">3. Buat Konsultasi Baru</h5>
                    <p class="card-text">Klik tombol "Buat Konsultasi Baru" untuk memulai diagnosa laptop Anda.</p>
                </div>
            </div>
        </div>
        <!-- Step 4 -->
        <div class="col-md-4">
            <div class="card step-card h-100 text-center">
                <div class="card-body">
                    <div class="step-icon mb-3">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h5 class="card-title">4. Pilih Gejala dan Tingkat Keyakinan</h5>
                    <p class="card-text">Tandai gejala yang sesuai dan atur tingkat keyakinan Anda pada setiap gejala yang dipilih.</p>
                </div>
            </div>
        </div>
        <!-- Step 5 -->
        <div class="col-md-4">
            <div class="card step-card h-100 text-center">
                <div class="card-body">
                    <div class="step-icon mb-3">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <h5 class="card-title">5. Proses Diagnosa</h5>
                    <p class="card-text">Sistem akan menganalisis gejala menggunakan metode Forward Chaining dan Certainty Factor.</p>
                </div>
            </div>
        </div>
        <!-- Step 6 -->
        <div class="col-md-4">
            <div class="card step-card h-100 text-center">
                <div class="card-body">
                    <div class="step-icon mb-3">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <h5 class="card-title">6. Hasil Diagnosa</h5>
                    <p class="card-text">Lihat hasil diagnosa beserta tingkat keyakinannya untuk mengetahui masalah pada laptop Anda.</p>
                </div>
            </div>
        </div>
        <!-- Step 7 -->
        <div class="col-md-4 mx-auto">
            <div class="card step-card h-100 text-center">
                <div class="card-body">
                    <div class="step-icon mb-3">
                        <i class="bi bi-download"></i>
                    </div>
                    <h5 class="card-title">7. Download Hasil</h5>
                    <p class="card-text">Unduh hasil diagnosa dalam format PDF untuk disimpan atau dicetak.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection