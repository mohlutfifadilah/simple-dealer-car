@extends('template.main')
@section('title', 'Detail Mobil')
@section('style')
    <style>
        /* Efek hover pada lingkaran warna */
        .color-circle:hover {
            transform: scale(1.1); /* Membesarkan lingkaran sedikit */
            transition: transform 0.3s ease;
        }

        /* Efek transisi gambar */
        #mobilImage {
            transition: opacity 0.5s ease;
        }
    </style>
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
                            <!-- Gambar Mobil -->
                            <div class="about-img">
                                <div class="img-1">
                                    <img id="mobilImage"
                                        src="{{ asset('storage/mobil/' . $warna[0]->gambar) }}" class="img-fluid rounded h-100 w-100" alt="Mobil {{ $mobil->nama_mobil }}" style="width: 250px; height: 250px; object-fit: cover; transition: opacity 0.5s ease;">
                                </div>
                            </div>

                            <!-- Nama Warna -->
                            <div class="mt-3">
                                <p id="namaWarna" class="text-bold text-center">
                                    {{ $warna[0]->warna }} <!-- Default nama warna -->
                                </p>
                            </div>

                            <!-- Pilihan Warna -->
                            <div class="color-selector mt-3 text-center">
                                @foreach ($warna as $w)
                                    <div class="color-circle"
                                        data-image="{{ asset('storage/mobil/' . $w->gambar) }}"
                                        data-warna="{{ $w->warna }}"
                                        style="background-color: {{ $w->kode_warna }};
                                                width: 20px;
                                                height: 20px;
                                                margin: 0 5px;
                                                border-radius: 50%;
                                                display: inline-block;
                                                cursor: pointer;
                                                border: 1px solid gray;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                            <div class="about-item">
                                <div class="pb-5">
                                    <h1 class="display-5 text-capitalize mb-4">{{ $mobil->nama }} <span class="text-primary"></span></h1>
                                    <div class="row gy-2 gx-0 mb-4">
                                        <div class="col-4 border-end border-gray mr-4">
                                            <span class="ms-1 text-bold" style="font-size: 14px; color: red;">Tipe</span>
                                        </div>
                                        <div class="col-4 ps-3">
                                            <span class="ms-1 text-bold" style="font-size: 14px; color: red;">Harga</span>
                                        </div>
                                    </div>
                                    @foreach ($varian as $v)
                                        <div class="row gy-2 gx-0 mb-4 bg-transparent">
                                            <div class="col-4 border-end border-gray mr-4">
                                                <span class="text-body ms-1">{{ $v->tipe }}</span>
                                            </div>
                                            <div class="col-4 ps-3">
                                                <span class="text-body ms-1">@currency($v->harga)</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="#" class="btn btn-primary rounded-pill d-flex justify-content-center py-3" data-bs-toggle="modal" data-bs-target="#pesanModal">Pesan Sekarang</a>
                                <a href="{!! route('download-brosur-client', $mobil->brosur ) !!}" class="btn btn-primary btn-sm mt-5 text-center">Download Brosur</a>
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
                                            <option value="{{ $w->warna }}">{{ $w->warna }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tipe" class="form-label">Pilih Tipe</label>
                                    <select class="form-select" id="tipe" name="tipe" required>
                                        @foreach ($varian as $v)
                                            <option value="{{ $v->tipe }} - @currency($v->harga)">{{ $v->tipe }} - @currency($v->harga)</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pesan" class="form-label">Pesan Tambahan</label>
                                    <textarea class="form-control" name="pesan" id="pesan" cols="30" rows="5" placeholder="Kondisional"></textarea>
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
    document.querySelectorAll('.color-circle').forEach(circle => {
        circle.addEventListener('click', function () {
            // Ambil elemen gambar dan nama warna
            const mobilImage = document.getElementById('mobilImage');
            const namaWarna = document.getElementById('namaWarna');

            // Ambil URL gambar dan nama warna baru dari atribut data
            const newImage = this.getAttribute('data-image');
            const newWarna = this.getAttribute('data-warna');

            // Animasi smooth untuk gambar
            mobilImage.style.opacity = '0'; // Fade-out gambar
            setTimeout(() => {
                mobilImage.src = newImage; // Ganti gambar
                mobilImage.style.opacity = '1'; // Fade-in gambar
            }, 500); // Durasi sesuai dengan transition CSS

            // Ganti nama warna secara langsung
            namaWarna.style.opacity = '0'; // Fade-out nama warna
            setTimeout(() => {
                namaWarna.textContent = newWarna; // Ganti nama warna
                namaWarna.style.opacity = '1'; // Fade-in nama warna
            }, 500); // Sinkronisasi durasi dengan gambar
        });

        // Tambahkan border pada warna yang dipilih
        circle.addEventListener('click', function () {
            document.querySelectorAll('.color-circle').forEach(c => c.style.border = '1px solid gray');
            this.style.border = '2px solid black';
        });
    });

    document.getElementById('kirimPesan').addEventListener('click', function () {
        // Ambil data dari modal
        const warna = document.getElementById('warna').value;
        const tipe = document.getElementById('tipe').value;
        const isi_pesan = document.getElementById('pesan').value;

        // Format pesan WhatsApp
        const nomor_wa = {{ str_replace('0', '62', substr($no, 0, 1)) . substr($no, 1) }}; // Ganti dengan nomor WhatsApp Anda
        const pesan = encodeURIComponent(
            `Halo, saya tertarik dengan mobil berikut:\n\n` +
            `Nama Mobil: {{ $mobil->nama }}\n` +
            `Warna: ${warna}\n` +
            `Tipe: ${tipe}\n` +
            `\n` +
            `\n` +
            `Pesan : ${isi_pesan}`
        );

        // Redirect ke WhatsApp
        const waLink = `https://wa.me/${nomor_wa}?text=${pesan}`;
        window.open(waLink, '_blank');
    });
@endsection
