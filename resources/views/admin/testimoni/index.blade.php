@extends('admin.template.main')
@section('title', 'Testimoni')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Testimoni</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Website</li>
                <li class="breadcrumb-item active">Testimoni</li>
            </ol>
            <div class="row">
                <div class="col">
                    <a href="{{ route('testimoni.create') }}" class="btn btn-success btn-sm mb-4"><i class="fas fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Testimoni
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Bintang</th>
                                        <th>Isi</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Bintang</th>
                                        <th>Isi</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($testimoni as $t)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/testimoni/' . $t->foto) }}" alt="user-avatar" class="img-fluid img-rounded" height="150" width="150" id="profileImage" />
                                            </td>
                                            <td>{{ $t->nama }}</td>
                                            <td>{{ $t->alamat }}</td>
                                            <td>
                                                @php
                                                    $filled = $t->bintang;
                                                    $notFilled = 5 - $filled;
                                                @endphp
                                                <div style="display: flex; gap: 2px; align-items: center;">
                                                    @for ($i = 1; $i <= $filled; $i++)
                                                        <i class="fas fa-star" style="color: #FFD43B;"></i>
                                                    @endfor
                                                    @for ($i = 1; $i <= $notFilled; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>{{ $t->isi }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap justify-content-center">
                                                    {{-- Tombol Edit --}}
                                                    <a class="btn btn-sm btn-warning text-white mb-2 mb-md-0 me-md-2"
                                                        href="{{ route('testimoni.edit', $t->id) }}">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>

                                                    {{-- Tombol Hapus --}}
                                                    <form id="delete-form-{{ $t->id }}" action="{{ route('testimoni.destroy', $t->id) }}"
                                                        method="post" class="mb-2 mb-md-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $t->id }}, 'Testimoni')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
