@extends('admin.template.main')
@section('title', 'Detail')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Detail</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Mobil</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
            <div class="row">
                <div class="col">
                    <a href="{{ route('info_mobil.create') }}" class="btn btn-success btn-sm mb-4"><i class="fas fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Detail
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Warna</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Warna</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($detail as $i)
                                    @php
                                        $mobil = \App\Models\Mobil::where('id', $i->id_mobil)->first();
                                    @endphp
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/mobil/' . $i->gambar) }}" alt="user-avatar"
                                            class="img-fluid" height="250" width="250" id="profileImage" />
                                            </td>
                                            <td>{{ $mobil->nama }}</td>
                                            <td>{{ $i->warna }} ({{ $i->kode_warna }})</td>
                                            <td>
                                                <div class="d-flex flex-wrap justify-content-center">
                                                    {{-- Tombol Edit --}}
                                                    <a class="btn btn-sm btn-warning text-white mb-2 mb-md-0 me-md-2"
                                                        href="{{ route('info_mobil.edit', $i->id) }}">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>

                                                    {{-- Tombol Hapus --}}
                                                    <form id="delete-form-{{ $i->id }}" action="{{ route('info_mobil.destroy', $i->id) }}"
                                                        method="post" class="mb-2 mb-md-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $i->id }}, 'Detail')">
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
