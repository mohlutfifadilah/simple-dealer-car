@extends('admin.template.main')
@section('title', 'Edit Akun')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Akun</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Edit Akun</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Silahkan isi formulir dibawah ini</h5>
                        <!-- Account -->
                        <form method="POST" action="{{ route('profil-user-update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input
                                        class="form-control @if(session('nama')) is-invalid @endif @error('nama') is-invalid @enderror"
                                        type="text"
                                        id="nama"
                                        name="nama"
                                        value="{{ $user->nama }}"
                                        placeholder=""
                                        />
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
                                        <label for="no" class="form-label">No Whatsapp</label>
                                        <input
                                        class="form-control @if(session('no')) is-invalid @endif @error('no') is-invalid @enderror"
                                        type="text"
                                        id="no"
                                        name="no"
                                        value="{{ $user->no }}"
                                        placeholder=""
                                        />
                                        @error('no')
                                            <small id="no" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('no'))
                                            <small id="no" class="text-danger">
                                                {{ session('no') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input
                                        class="form-control @if(session('email')) is-invalid @endif @error('email') is-invalid @enderror"
                                        type="text"
                                        id="email"
                                        name="email"
                                        value="{{ $user->email }}"
                                        placeholder=""
                                        />
                                        @error('email')
                                            <small id="email" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('email'))
                                            <small id="email" class="text-danger">
                                                {{ session('email') }}
                                            </small>
                                        @endif
                                    </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <a class="btn btn-outline-danger" href="{{ route('change-password', Auth::user()->id) }}">Ganti Password</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
