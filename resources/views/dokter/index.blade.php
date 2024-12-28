@extends('layouts.admin')

@section('main-content')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1 class="h3 text-gray-800">Data Dokter</h1>
            <p class="mb-4">Tabel Data Dokter</p>
        </div>
        <div style="float: right">
            <a href="{{ route('dokter.create') }}" class="btn btn-primary mb-4">Tambah</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIP/NIB</th>
                    <th>Subdivisi</th>
                    <th>Spesialisasi</th>
                    <th>Status</th>
                    @if(Auth::user()->id_role === 1)
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($dokter as $item)
                <tr>
                <tr class="{{ $item->status == 'Nonaktif' ? 'nonaktif' : '' }}">
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nipnib }}</td>
                    <td>{{ $item->subdivisi }}</td>
                    <td>{{ $item->spesialisasi }}</td>
                    <td>{{ $item->status }}</td>
                    @if(Auth::user()->id_role === 1)
                    <td>
                    <div class="d-flex">
                        <a href="{{ route('dokter.edit', $item->id) }}"class="btn btn-warning edit-button">
                                    <i class="fa fa-pencil"></i>
                                </a>
                        <!-- <form action="{{ route('dokter.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger delete-button show_confirm" data-nama="{{ $item->nama }}"><i class="fa fa-trash"></i>
                                    </button> -->

                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@if(session('success'))
    <script>
        swal({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            button: "OK",
        });
    </script>
@endif
