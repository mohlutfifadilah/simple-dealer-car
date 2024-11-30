@extends('admin.template.main')
@section('title', 'Testimoni')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Testimoni</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Website</li>
                <li class="breadcrumb-item">Testimoni</li>
                <li class="breadcrumb-item active">Tambah Testimoni</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('testimoni.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input class="form-control @if(session('foto')) is-invalid @endif @error('foto') is-invalid @enderror" type="file" id="foto" name="foto" value="" placeholder="" />
                                        <small class="text-muted">
                                            * Ukuran : 150x150 <br>
                                            * Maksimal ukuran foto 2 gb (jpeg, jpg, png) <br>
                                        </small>
                                        @error('foto')
                                            <small id="foto" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('foto'))
                                            <small id="foto" class="text-danger">
                                                {{ session('foto') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nama" class="form-label">Nama Konsumen</label>
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
                                    <div class="mb-3 col-md-6">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input class="form-control @if(session('alamat')) is-invalid @endif @error('alamat') is-invalid @enderror" type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" placeholder="" />
                                        <small id="" class="text-muted">
                                            * Contoh : Gunungpati, Kota Semarang
                                        </small>
                                        @error('alamat')
                                            <small id="alamat" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('alamat'))
                                            <small id="alamat" class="text-danger">
                                                {{ session('alamat') }}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="bintang" class="form-label">Bintang</label>
                                        <input class="form-control @if(session('bintang')) is-invalid @endif @error('bintang') is-invalid @enderror" type="text" id="onlyNumber" name="bintang" value="{{ old('bintang') }}" placeholder="" />
                                        @error('bintang')
                                            <small id="bintang" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('bintang'))
                                            <small id="bintang" class="text-danger">
                                                {{ session('bintang') }}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="isi" class="form-label">Isi</label>
                                        <textarea name="isi" id="isi" cols="30" rows="10" class="form-control @if(session('isi')) is-invalid @endif @error('isi') is-invalid @enderror" placeholder="Isikan testimoni disini">
                                            {{ old('isi') }}
                                        </textarea>
                                        @error('isi')
                                            <small id="isi" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('isi'))
                                            <small id="isi" class="text-danger">
                                                {{ session('isi') }}
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
@section('js')
    const input = document.getElementById("onlyNumber");

    input.addEventListener("input", function (e) {
        // Hapus karakter yang bukan angka
        this.value = this.value.replace(/[^0-9]/g, "");
    });
@endsection
