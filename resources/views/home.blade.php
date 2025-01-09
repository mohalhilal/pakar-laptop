@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <h1 class="display-5 text-center">Sistem Pakar Kerusakan Laptop Metode Forward Chaining</h1>
            <br>
            <h3>Dikelola Oleh : CV Multinet Compindo</h3>
            <br>
            @if(!Auth::user())
            <div class="text-center">
                <a href="{{ route('register')}}" class="btn btn-primary btn-lg text-center">Daftar untuk konsultasi</a>
            </div>
            @else
            <div class="text-center">
                <a href="{{ route('konsultasi')}}" class="btn btn-primary btn-lg text-center">Mulai konsultasi</a>
            </div>
            @endif

        </div>
    </section>

    <!-- Fitur Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="feature-icon">✍</div>
                    <h3>Konsultasi</h3>
                    <p>User memberikan jawaban berdasarkan kendala yang dialami.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon">🕵️‍♀️</div>
                    <h3>Diagnosa</h3>
                    <p>Sistem Pakar akan memproses jawaban user untuk dilakukan diagnosa kerusakan.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon">💡</div>
                    <h3>Solusi</h3>
                    Sistem Pakar akan memberikan hasil akhir diagnosa beserta dengan solusinya.
                </div>
            </div>
        </div>
    </section>



    <section class="py-5">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Apa itu Sistem Pakar?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Sistem pakar adalah program komputer yang dirancang untuk meniru kemampuan seorang ahli dalam memecahkan masalah atau memberikan rekomendasi di bidang tertentu. Sistem ini bekerja dengan memanfaatkan basis pengetahuan (knowledge base) yang berisi informasi dan aturan yang telah dikumpulkan dari para ahli, serta mesin inferensi (inference engine) yang digunakan untuk menganalisis data dan menarik kesimpulan. Tujuan utama sistem pakar adalah membantu pengguna yang bukan ahli untuk mendapatkan solusi yang andal, seolah-olah mereka berkonsultasi langsung dengan seorang ahli.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Apa itu metode Forward Chaining
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        Forward chaining adalah metode penalaran dalam sistem pakar yang memulai analisis dari data atau fakta yang tersedia, kemudian menggunakan aturan-aturan yang ada untuk menarik kesimpulan baru secara bertahap hingga mencapai tujuan atau solusi akhir. Proses ini dilakukan secara progresif, mulai dari premis (fakta awal) menuju konklusi (hasil).
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Header -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="bg-secondary">
                    <iframe src=" https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.421774951712!2d108.5650393!3d-6.718275299999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee3fc6e400f45%3A0xf0f7b0a659c0e481!2sMultinet%20Compindo%20Cirebon!5e0!3m2!1sen!2sid!4v1735446685592!5m2!1sen!2sid" width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="mb-3">Tentang Kami</h2>
                <p>CV. Multinet Compindo adalah perusahaan yang bergerak di bidang
                    penjualan dan layanan servis perangkat teknologi, termasuk komputer dan
                    laptop. Fokus utama perusahaan ini adalah memberikan solusi lengkap dan
                    berkualitas untuk kebutuhan perbaikan laptop, baik untuk penggunaan pribadi
                    maupun komersial.</p>
                <p><strong>Alamat :</strong> Jl. Panjunan, Panjunan, Kec. Lemahwungkuk, Kota Cirebon, Jawa Barat</p>
                <p><strong>Email:</strong> multinet_crb@yahoo.co.id | <strong>Telepon:</strong> 0853-2122-2686</p>
            </div>
        </div>
    </div>

    <!-- Profil Tokopedia -->
    <div class="bg-light py-5">
        <div class="container text-center">
            <h3 class="mb-4">Kunjungi Marketplace Kami</h3>
            <div class="card mx-auto" style="max-width: 100%;">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-secondary rounded-circle" style="width: 50px; height: 50px;">
                            <img src="{{ asset('/storage/multinet-tokped-profile.jpg') }}" class="rounded-circle" width="100%" alt="">
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0">Multinet compindo</h5>
                            <small class="text-muted">Rating 5.0 | Pengiriman Cepat</small>
                        </div>
                    </div>
                    <p class="mb-3">Toko kami menyediakan berbagai produk teknologi berkualitas tinggi untuk memenuhi kebutuhan profesional dan personal Anda. Kami berkomitmen untuk memberikan pelayanan terbaik serta produk dengan kualitas terpercaya.</p>
                    <a href="https://www.tokopedia.com/multinetcompindo" target="_blank" class="btn btn-success">Kunjungi Toko</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ulasan Tokopedia -->
    <div class="container my-5">
        <h3 class="text-center mb-4">Ulasan Marketplace</h3>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">⭐⭐⭐⭐⭐</h5>
                        <p class="card-text">"Barang sesuai pesanan, segel utuh. recomended baget. pelayanan juga ramah banget, pokoknya. 😊😊😊"</p>
                        <small class="text-muted">Iswati - Tokopedia</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">⭐⭐⭐⭐⭐</h5>
                        <p class="card-text">"Respons seller bagus banget, ramah dan cepat. Kualitas barang sesuai deskripsi. Packing tebal dan pengiriman cepat. Highly recomended."</p>
                        <small class="text-muted">Tito - Tokopedia.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">⭐⭐⭐⭐⭐</h5>
                        <p class="card-text">"benar2 top seller. sy pembelian rabu. sy tanya dl lah. stok ready gak. dan langsung d response. dan yg penting harganya wajar. beda sm seller lain. mentang2 langka di naikkan. benar2 top seller. rabu order. hari itu jg d proses. kamisnya sampe. cirebon sidoarjo 1 day. sudah d test dan berfungsi baik dan original."</p>
                        <small class="text-muted">-D***a - Tokopedia.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection