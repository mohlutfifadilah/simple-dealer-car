@extends('admin.template.main')
@section('title', 'Varian')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Varian</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Data</li>
                <li class="breadcrumb-item">Mobil</li>
                <li class="breadcrumb-item active">Tambah Varian</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('varian.store') }}">
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
                                    <div class="mb-3 col-md-6">
                                        <label for="tipe" class="form-label">Tipe</label>
                                        <input class="form-control @if(session('tipe')) is-invalid @endif @error('tipe') is-invalid @enderror" type="text" id="tipe" name="tipe" value="{{ old('tipe') }}" placeholder="" />
                                        <small class="text-muted">
                                            * Contoh : GX A/T
                                        </small>
                                        @error('tipe')
                                            <small id="tipe" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('tipe'))
                                            <small id="tipe" class="text-danger">
                                                {{ session('tipe') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input class="form-control @if(session('harga')) is-invalid @endif @error('harga') is-invalid @enderror" type="harga" id="rupiahInput" name="harga" value="" placeholder="" />
                                        @error('harga')
                                            <small id="harga" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('harga'))
                                            <small id="harga" class="text-danger">
                                                {{ session('harga') }}
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
    const rupiah = document.getElementById("rupiahInput");

    rupiah.addEventListener("input", function (e) {
        let value = this.value;

        // Hapus semua karakter selain angka
        value = value.replace(/[^0-9]/g, "");

        // Tambahkan format Rupiah
        this.value = formatRupiah(value);
    });

    function formatRupiah(angka) {
        if (!angka) return "";

        // Tambahkan tanda "Rp" dan format ribuan
        return "Rp " + angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
@endsection
