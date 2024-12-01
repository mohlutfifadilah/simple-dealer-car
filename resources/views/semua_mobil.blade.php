@extends('template.main')
@section('title', 'Mobil')
@section('style')

@endsection
@section('content')
<!-- Testimonial Start -->
            <div class="container-fluid testimonial pt-5 pb-5">
                <div class="container pb-5">
                    <ol class="breadcrumb d-flex mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="/" class="text-primary">Beranda</a></li>
                        <li class="breadcrumb-item active">Mobil</li>
                    </ol>
                    <div class="text-center mx-auto pb-3 mb-3 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                        <h1 class="display-5 text-capitalize"><span class="text-primary"> Mobil</span></h1>
                        <!-- <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut amet nemo expedita asperiores commodi accusantium at cum harum, excepturi, quia tempora cupiditate! Adipisci facilis modi quisquam quia distinctio,
                        </p> -->
                    </div>
                    <div class="row">
                        @foreach ($mobil as $m)
                            <div class="col-xl-4">
                                <div class="categories-item p-4">
                                    <div class="categories-item-inner text-center">
                                        <div class="categories-img rounded-top">
                                            <img src="{{ asset('storage/mobil/' . $m->gambar) }}" class="img-fluid w-100 rounded-top" alt="" style="width: 250px; height: 250px;">
                                        </div>
                                        <div class="categories-content rounded-bottom p-4">
                                            <h4>{{ $m->nama }}</h4>
                                            {{-- <div class="categories-review mb-4">
                                                <div class="me-3">4.5 Review</div>
                                                <div class="d-flex justify-content-center text-secondary">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star text-body"></i>
                                                </div>
                                            </div> --}}
                                            @php
                                                $lowest_price = \App\Models\Varian::where('id_mobil', $m->id)->min('harga');
                                                $count_tipe = \App\Models\Varian::where('id_mobil', $m->id)->count();
                                            @endphp
                                            <div class="mb-4">
                                                <h4 class="bg-white text-primary rounded-pill py-2 px-4 mb-0">Mulai dari @currency($lowest_price)</h4>
                                            </div>
                                            <div class="row gy-2 gx-0 text-center mb-4">
                                                <div class="col-6 border-end border-white">
                                                    <i class="fa fa-paint-roller text-dark"></i> <span class="text-body ms-1">{{ $m->warna }} Warna</span>
                                                </div>
                                                <div class="col-6">
                                                    <i class="fa fa-car text-dark"></i> <span class="text-body ms-1">{{ $count_tipe }} Tipe</span>
                                                </div>
                                            </div>
                                            <a href="{{ route('detail_mobil', $m->id) }}" class="btn btn-primary rounded-pill d-flex justify-content-center py-3">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Testimonial End -->
@endsection
@section('script')

@endsection
