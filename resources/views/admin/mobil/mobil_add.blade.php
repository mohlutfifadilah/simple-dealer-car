@extends('admin.template.main')
@section('title', 'Mobil')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Mobil</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Mobil</li>
                <li class="breadcrumb-item">Mobil</li>
                <li class="breadcrumb-item active">Tambah Mobil</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('mobil.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="brosur" class="form-label">Upload Brosur</label>
                                        <input class="form-control @if(session('brosur')) is-invalid @endif @error('brosur') is-invalid @enderror" type="file" id="brosur" name="brosur" value="" placeholder="" />
                                        <small class="text-muted">
                                            * Maksimal ukuran brosur 2mb <br>
                                        </small>
                                        @error('brosur')
                                            <small id="brosur" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('brosur'))
                                            <small id="brosur" class="text-danger">
                                                {{ session('brosur') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nama" class="form-label">Nama Mobil</label>
                                        <input class="form-control @if(session('nama')) is-invalid @endif @error('nama') is-invalid @enderror" type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="" />
                                        @error('nama')
                                            <small id="nama" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('nama'))
                                            <small id="nama" class="text-danger">
                                                {{ session('nama') }}
                                            </small>
                                        @endif
                                    </div>
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="warna" class="form-label">Jumlah Warna</label>
                                        <input class="form-control @if(session('warna')) is-invalid @endif @error('warna') is-invalid @enderror" type="text" id="onlyNumber" name="warna" value="{{ old('warna') }}" placeholder="" />
                                        @error('warna')
                                            <small id="warna" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('warna'))
                                            <small id="warna" class="text-danger">
                                                {{ session('warna') }}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="detail_warna" class="form-label">Detail Warna</label>
                                        <input class="form-control @if(session('detail_warna')) is-invalid @endif @error('detail_warna') is-invalid @enderror" type="text" id="detail_warna" name="detail_warna" value="{{ old('detail_warna') }}" placeholder="Contoh : Biru, Silver" />
                                        @error('detail_warna')
                                            <small id="detail_warna" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('detail_warna'))
                                            <small id="detail_warna" class="text-danger">
                                                {{ session('detail_warna') }}
                                            </small>
                                        @endif
                                    </div> --}}
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
@section('js')
    const input = document.getElementById("onlyNumber");

    input.addEventListener("input", function (e) {
        // Hapus karakter yang bukan angka
        this.value = this.value.replace(/[^0-9]/g, "");
    });
@endsection
