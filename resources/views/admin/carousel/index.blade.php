@extends('admin.template.main')
@section('title', 'Mobil')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Mobil</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Mobil</li>
                <li class="breadcrumb-item active">Mobil</li>
            </ol>
            <div class="row">
                <div class="col">
                    <a href="{{ route('mobil.create') }}" class="btn btn-success btn-sm mb-4"><i class="fas fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Mobil
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Warna</th>
                                        <th>Detail Warna</th>
                                        <th>Varian</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Warna</th>
                                        <th>Detail Warna</th>
                                        <th>Varian</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($mobil as $m)
                                    @php
                                        $varian = \App\Models\Varian::where('id_mobil', $m->id)->get();
                                    @endphp
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/mobil/' . $m->gambar) }}" alt="user-avatar"
                                            class="img-fluid" height="250" width="250" id="profileImage" />
                                            </td>
                                            <td>{{ $m->nama }}</td>
                                            <td>{{ $m->warna }}</td>
                                            <td>{{ $m->detail_warna }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($varian as $v)
                                                        <li class="mb-3">
                                                            {{ $v->tipe }} &nbsp; | &nbsp; @currency($v->harga)
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap justify-content-center">
                                                    {{-- Tombol Edit --}}
                                                    <a class="btn btn-sm btn-warning text-white mb-2 mb-md-0 me-md-2"
                                                        href="{{ route('mobil.edit', $m->id) }}">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>

                                                    {{-- Tombol Hapus --}}
                                                    <form id="delete-form-{{ $m->id }}" action="{{ route('mobil.destroy', $m->id) }}"
                                                        method="post" class="mb-2 mb-md-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $m->id }}, 'Mobil')">
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
