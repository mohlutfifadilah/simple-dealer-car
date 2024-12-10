@extends('admin.template.main')
@section('title', 'Detail')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Detail</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Mobil</li>
                <li class="breadcrumb-item">Detail</li>
                <li class="breadcrumb-item active">Tambah Detail</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('info_mobil.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="mobil" class="form-label">Mobil</label>
                                        <select class="form-control @if(session('mobil')) is-invalid @endif @error('mobil') is-invalid @enderror" id="mobil" name="mobil">
                                            <option selected disabled value="">Pilih Mobil</option>
                                            @foreach ($mobil as $m)
                                                <option value="{{ $m->id }}" {{ old('mobil') == $m->id ? 'selected' : '' }}>{{ $m->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('mobil')
                                            <small id="mobil" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('mobil'))
                                            <small id="mobil" class="text-danger">
                                                {{ session('mobil') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input class="form-control @if(session('gambar')) is-invalid @endif @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" value="" placeholder="" />
                                        <small class="text-muted">
                                            * Ukuran : 250x250 <br>
                                            * Maksimal ukuran gambar 2 mb (jpeg, jpg, png) <br>
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
                                    <div class="mb-3 col-md-6">
                                        <label for="warna" class="form-label">Warna</label>
                                        <input class="form-control @if(session('warna')) is-invalid @endif @error('warna') is-invalid @enderror" type="text" id="warna" name="warna" value="{{ old('warna') }}" placeholder="Contoh : Biru" />
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
                                        <label for="kode_warna" class="form-label">Kode Warna</label>
                                        <input class="form-control @if(session('kode_warna')) is-invalid @endif @error('kode_warna') is-invalid @enderror" type="text" id="kode_warna" name="kode_warna" value="{{ old('kode_warna') }}" placeholder="Contoh : #D28MW1" />
                                        @error('kode_warna')
                                            <small id="kode_warna" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('kode_warna'))
                                            <small id="kode_warna" class="text-danger">
                                                {{ session('kode_warna') }}
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
{{-- @section('js')
    const input = document.getElementById("onlyNumber");

    input.addEventListener("input", function (e) {
        // Hapus karakter yang bukan angka
        this.value = this.value.replace(/[^0-9]/g, "");
    });
@endsection --}}
