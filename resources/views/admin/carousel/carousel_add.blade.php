@extends('admin.template.main')
@section('title', 'Carousel')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Carousel</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Website</li>
                <li class="breadcrumb-item">Carousel</li>
                <li class="breadcrumb-item active">Tambah Carousel</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('carousel.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="gambar" class="form-label">Upload Gambar</label>
                                        <input class="form-control @if(session('gambar')) is-invalid @endif @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" value="" placeholder="" />
                                        <small class="text-muted">
                                            * Ukuran : 650x370 <br>
                                            * Maksimal ukuran gambar 2mb (jpeg, jpg, png) <br>
                                        </small>
                                        @error('gambar')
                                            <small id="gambar" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('gambar'))
                                            <small id="gambar" class="text-danger">
                                                {{ session('gambar') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-2 justify-content-end">
                                    <button type="submit" class="btn btn-success me-2"><i class="fas fa-plus"></i> Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
