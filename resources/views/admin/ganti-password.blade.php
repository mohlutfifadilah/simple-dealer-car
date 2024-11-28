@extends('admin.template.main')
@section('title', 'Ganti Password')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Ganti Password</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Ganti Password</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Silahkan isi formulir dibawah ini</h5>
                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <form id="formAccountSettings" method="POST" action="{{ route('update-password', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 col-md-6">
                                        <label for="oldPassword" class="form-label">Password Lama</label>
                                        <input class="form-control @if(session('oldPassword')) is-invalid @endif @error('oldPassword') is-invalid @enderror" type="password" id="oldPassword" name="oldPassword" value="" placeholder="" />
                                        @error('oldPassword')
                                            <small id="oldPassword" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('oldPassword'))
                                            <small id="oldPassword" class="text-danger">
                                                {{ session('oldPassword') }}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="newPassword" class="form-label">Password Baru</label>
                                        <input
                                            class="form-control @if(session('newPassword')) is-invalid @endif @error('newPassword') is-invalid @enderror"
                                            type="password"
                                            id="newPassword"
                                            name="newPassword"
                                            value=""
                                            placeholder=""
                                        />
                                        @error('newPassword')
                                            <small id="newPassword" class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        @if (session('newPassword'))
                                            <small id="newPassword" class="text-danger">
                                                {{ session('newPassword') }}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input
                                            class="form-control @if(session('newPassword')) is-invalid @endif @error('newPassword') is-invalid @enderror"
                                            type="password"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            value=""
                                            placeholder=""
                                        />
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                        <a class="btn btn-outline-secondary" href="{{ route('profil-user-edit', Auth::user()->id) }}">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
