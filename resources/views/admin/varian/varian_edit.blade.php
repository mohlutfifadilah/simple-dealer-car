@extends('admin.template.main')
@section('title', 'User')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Akun</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Data</li>
                <li class="breadcrumb-item">Pengguna</li>
                <li class="breadcrumb-item active">Edit Akun</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input class="form-control @if(session('nama')) is-invalid @endif @error('nama') is-invalid @enderror" type="text" id="nama" name="nama" value="{{ $user->nama }}" placeholder="" />
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
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control @if(session('email')) is-invalid @endif @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{ $user->email }}" placeholder="" />
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
                                </div>
                                <div class="mt-2 justify-content-end">
                                    <button type="submit" class="btn btn-warning me-2 text-white"><i class="fas fa-edit"></i> Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
