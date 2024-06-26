@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4">
        <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
            <i class="fas fa-lg fa-arrow-left"></i>
        </a>
        <h1 class="h3 text-gray-800">{{ __('Tambah Informasi dan Komplain') }}</h1>
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

    <form action="{{ route('infodankomplain.store') }}" method="POST">
        @csrf
        <div class="px-3">
            <div class="form-group m-3">
                <label for="tgl">Tanggal 
                    <input type="date" class="form-control " id="tgl"  name="tgl" required>
                </label>
            </div>

            <div class="form-group">
                <label for="jenis_berita">Jenis Berita</label>
                <select class="form-control" id="jenis_berita" name="jenis_berita" required>
                    <option value="Informasi">Informasi</option>
                    <option value="Komplain">Komplain</option>
                </select>
            </div>

            <div class="form-group">
                <label for="media_sosial">Media Sosial</label>
                <select class="form-control" id="media_sosial" name="media_sosial" required>
                    <option value="Instagram">Instagram</option>
                    <option value="Facebook">Facebook</option>
                    <option value="TikTok">TikTok</option>
                </select>
            </div>

            <div class="form-group">
                <label for="isi_berita">Isi Berita</label>
                <textarea class="form-control" id="isi_berita" name="isi_berita" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="kelompok">Kelompok</label>
                <select class="form-control" id="kelompok" name="kelompok" required>
                    <option value="Layanan">Layanan</option>
                    <option value="Parkir">Parkir</option>
                    <option value="Pembayaran">Pembayaran</option>
                    <option value="Dokter">Dokter</option>
                    <option value="Pendaftaran">Pendaftaran</option>
                    <option value="Hasil Pemeriksaan">Hasil Pemeriksaan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_user">Tim Promkes</label>
                <select class="form-control select2" id="id_user" name="id_user" required>
                    <option value="" disabled selected>Pilih Tim Promkes</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('infodankomplain.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih Tim Promkes",
                allowClear: true
            });
        });
    </script>
@endpush

@endsection
