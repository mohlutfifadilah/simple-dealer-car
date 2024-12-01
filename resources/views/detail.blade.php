@extends('template.main')
@section('title', 'Detail Mobil')
@section('style')

@endsection
@section('content')
<!-- Testimonial Start -->
            <div class="container-fluid testimonial pt-5 pb-5">
                <div class="container pb-5">
                    <ol class="breadcrumb d-flex mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="/" class="text-primary">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="/semua_mobil" class="text-primary">Mobil</a></li>
                        <li class="breadcrumb-item active">Detail Mobil</li>
                    </ol>
                    <div class="text-center mx-auto pb-3 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                        <h1 class="display-5 text-capitalize">Detail<span class="text-primary"> Mobil</span></h1>
                        <!-- <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut amet nemo expedita asperiores commodi accusantium at cum harum, excepturi, quia tempora cupiditate! Adipisci facilis modi quisquam quia distinctio,
                        </p> -->
                    </div>
                    <div class="row g-5 mt-2 pt-1">
                        <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                            <div class="about-img">
                                <div class="img-1">
                                    <img src="{{ asset('storage/mobil/' . $mobil->gambar) }}" class="img-fluid rounded h-100 w-100" alt="" style="width: 250px; height: 250px;">
                                </div>
                                <!-- <div class="img-2">
                                    <img src="img/about2.jpg" class="img-fluid rounded w-100" alt="">
                                </div> -->
                            </div>
                        </div>
                        <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                            <div class="about-item">
                                <div class="pb-5">
                                    <h1 class="display-5 text-capitalize">{{ $mobil->nama }} <span class="text-primary"></span></h1>
                                    <p class="mb-3">
                                        Tersedia {{ $mobil->warna }} Warna :
                                    </p>
                                    @php
                                        $warna = explode(',', $mobil->detail_warna);
                                    @endphp
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <div class="rounded">
                                                @foreach ($warna as $w)
                                                    <p class="mb-2"><i class="fa fa-check-circle text-primary me-1"></i> {{ $w }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-3">
                                        Harga :
                                    </p>
                                    @foreach ($varian as $v)
                                        <div class="row gy-2 gx-0 mb-4">
                                            <div class="col-4 border-end border-white">
                                                <span class="text-body ms-1">{{ $v->tipe }}</span>
                                            </div>
                                            <div class="col-4">
                                                <span class="text-body ms-1">@currency($v->harga)</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="#" class="btn btn-primary rounded-pill d-flex justify-content-center py-3" data-bs-toggle="modal" data-bs-target="#pesanModal">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial End -->
            <div class="modal fade" id="pesanModal" tabindex="-1" aria-labelledby="pesanModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pesanModalLabel">Pesan Mobil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="pesanForm">
                                <div class="mb-3">
                                    <label for="warna" class="form-label">Pilih Warna</label>
                                    <select class="form-select" id="warna" name="warna" required>
                                        @foreach ($warna as $w)
                                            <option value="{{ $w }}">{{ $w }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tipe" class="form-label">Pilih Tipe</label>
                                    <select class="form-select" id="tipe" name="tipe" required>
                                        @foreach ($varian as $v)
                                            <option value="{{ $v->tipe }}">{{ $v->tipe }} - @currency($v->harga)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="kirimPesan">Kirim ke WhatsApp</button>
                        </div>
                    </div>
                </div>
            </div>

@endsection
@section('script')
    document.getElementById('kirimPesan').addEventListener('click', function () {
        // Ambil data dari modal
        const warna = document.getElementById('warna').value;
        const tipe = document.getElementById('tipe').value;

        // Format pesan WhatsApp
        const nomor_wa = '6287731680018'; // Ganti dengan nomor WhatsApp Anda
        const pesan = encodeURIComponent(
            `Halo, saya tertarik dengan mobil berikut:\n\n` +
            `Nama Mobil: {{ $mobil->nama }}\n` +
            `Warna: ${warna}\n` +
            `Tipe: ${tipe}\n`
        );

        // Redirect ke WhatsApp
        const waLink = `https://wa.me/${nomor_wa}?text=${pesan}`;
        window.open(waLink, '_blank');
    });
@endsection
