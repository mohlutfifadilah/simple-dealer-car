@extends('admin.template.main')
@section('title', 'Varian')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Mobil</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Mobil</li>
                <li class="breadcrumb-item active">Varian</li>
            </ol>
            <div class="row">
                <div class="col">
                    <a href="{{ route('varian.create') }}" class="btn btn-success btn-sm mb-4"><i class="fas fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Varian
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nama Mobil</th>
                                        <th>Tipe</th>
                                        <th>Harga</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nama Mobil</th>
                                        <th>Tipe</th>
                                        <th>Harga</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($varian as $u)
                                    @php
                                        $mobil = App\Models\Mobil::find($u->id_mobil);
                                    @endphp
                                        <tr>
                                            <td>{{ $mobil->nama }}</td>
                                            <td>{{ $u->tipe }}</td>
                                            <td>@currency($u->harga)</td>
                                            <td>
                                                <div class="d-flex flex-wrap justify-content-center">
                                                    {{-- Tombol Edit --}}
                                                    <a class="btn btn-sm btn-warning text-white mb-2 mb-md-0 me-md-2"
                                                        href="{{ route('varian.edit', $u->id) }}">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>

                                                    {{-- Tombol Hapus --}}
                                                    <form id="delete-form-{{ $u->id }}" action="{{ route('varian.destroy', $u->id) }}"
                                                        method="post" class="mb-2 mb-md-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $u->id }}, 'Varian')">
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
