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
                                        <th>Nama</th>
                                        <th>Detail</th>
                                        <th>Brosur</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Detail</th>
                                        <th>Brosur</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($mobil as $m)
                                    @php
                                        $count_warna = \App\Models\InfoMobil::where('id_mobil', $m->id)->count();
                                        $varian = \App\Models\Varian::where('id_mobil', $m->id)->first();
                                        $count_tipe = \App\Models\Varian::where('id_mobil', $m->id)->count();
                                    @endphp
                                        <tr>
                                            <td>{{ $m->nama }}</td>
                                            <td>
                                                Warna : {{ $count_warna }} Warna <br>
                                                Varian : {{ $count_tipe }} Varian
                                            </td>
                                            <td>
                                                @if ($m->brosur === '')
                                                    -
                                                @else
                                                    <a href="{!! route('download-brosur', $m->brosur ) !!}" class="btn btn-primary btn-sm">Download Brosur</a>
                                                @endif
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
