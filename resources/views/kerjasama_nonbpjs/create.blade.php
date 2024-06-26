@extends('layouts.admin')

@section('main-content')
    <div class="d-flex align-items-center mb-4">
        <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
            <i class="fas fa-lg fa-arrow-left"></i>
        </a>
        <h1 class="h3 text-gray-800">{{ __('Tambah Kerja Sama Non BPJS') }}</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kerjasama_nonbpjs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="tgl_mulai">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" required>
        </div>

        <div class="form-group">
            <label for="tgl_akhir">Tanggal Akhir</label>
            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" required>
        </div>

        <div class="form-group">
            <label for="id_mitra">Mitra</label>
            <select class="form-control select2" id="id_mitra" name="id_mitra" required>
                <option value="" disabled selected>Pilih Mitra</option>
                @foreach ($mitras as $mitra)
                    <option value="{{ $mitra->id }}">{{ $mitra->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jenis_kerjasama">Jenis Kerjasama</label>
            <select class="form-control" id="jenis_kerjasama" name="jenis_kerjasama" required>
                <option value="Layanan Rawat Jalan & Rawat Inap">Layanan Rawat Jalan & Rawat Inap</option>
                <option value="Layanan Kesehatan">Layanan Kesehatan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Baru">Baru</option>
                <option value="Perpanjangan">Perpanjangan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="id_user">PIC</label>
            <select class="form-control select2" id="id_user" name="id_user" required>
                <option value="" disabled selected>Pilih PIC</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="no_telp_pic">No. Telp PIC</label>
            <input type="text" class="form-control" id="no_telp_pic" name="no_telp_pic" required>
        </div>

        <div class="form-group">
            <label for="dokumentasi">Dokumentasi</label>
            <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kerjasama_nonbpjs.index') }}" class="btn btn-secondary">Batal</a>
    </form>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#id_mitra').select2({
                placeholder: "Pilih Mitra",
                allowClear: true
            });
            $('#id_user').select2({
                placeholder: "Pilih PIC",
                allowClear: true
            });
        });
    </script>
    @endpush

@endsection
