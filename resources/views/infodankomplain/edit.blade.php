@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4">
        <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
            <i class="fas fa-lg fa-arrow-left"></i>
        </a>
        <h1 class="h3 text-gray-800">{{ __('Edit Informasi dan Komplain') }}</h1>
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

    <form action="{{ route('infodankomplain.update', $infoKomplain->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="px-3">
            <div class="form-group m-3">
                <label for="tgl">Tanggal 
                    <input type="date" class="form-control " id="tgl" name="tgl" value="{{ $infoKomplain->tgl }}" required>
                </label>
            </div>

            <div class="form-group">
                <label for="jenis_berita">Jenis Berita</label>
                <select class="form-control" id="jenis_berita" name="jenis_berita" required>
                    <option value="Informasi" {{ $infoKomplain->jenis_berita == 'Informasi' ? 'selected' : '' }}>Informasi</option>
                    <option value="Komplain" {{ $infoKomplain->jenis_berita == 'Komplain' ? 'selected' : '' }}>Komplain</option>
                </select>
            </div>

            <div class="form-group">
                <label for="media_sosial">Media Sosial</label>
                <select class="form-control" id="media_sosial" name="media_sosial" required>
                    <option value="Instagram" {{ $infoKomplain->media_sosial == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                    <option value="Facebook" {{ $infoKomplain->media_sosial == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                    <option value="TikTok" {{ $infoKomplain->media_sosial == 'TikTok' ? 'selected' : '' }}>TikTok</option>
                </select>
            </div>

            <div class="form-group">
                <label for="isi_berita">Isi Berita</label>
                <textarea class="form-control" id="isi_berita" name="isi_berita" rows="3" required>{{ $infoKomplain->isi_berita }}</textarea>
            </div>

            <div class="form-group">
                <label for="kelompok">Kelompok</label>
                <select class="form-control" id="kelompok" name="kelompok" required>
                    <option value="Layanan" {{ $infoKomplain->kelompok == 'Layanan' ? 'selected' : '' }}>Layanan</option>
                    <option value="Parkir" {{ $infoKomplain->kelompok == 'Parkir' ? 'selected' : '' }}>Parkir</option>
                    <option value="Pembayaran" {{ $infoKomplain->kelompok == 'Pembayaran' ? 'selected' : '' }}>Pembayaran</option>
                    <option value="Dokter" {{ $infoKomplain->kelompok == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                    <option value="Pendaftaran" {{ $infoKomplain->kelompok == 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                    <option value="Hasil Pemeriksaan" {{ $infoKomplain->kelompok == 'Hasil Pemeriksaan' ? 'selected' : '' }}>Hasil Pemeriksaan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_user">Tim Promkes</label>
                <select class="form-control select2" id="id_user" name="id_user" required>
                    <option value="" disabled selected>Pilih TIm Promkes</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $infoKomplain->id_user == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
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
