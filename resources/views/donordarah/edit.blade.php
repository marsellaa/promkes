@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4">
        <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
            <i class="fas fa-lg fa-arrow-left"></i>
        </a>
        <h1 class="h3 text-gray-800">{{ __('Edit Kegiatan Donor Darah') }}</h1>
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

    <form action="{{ route('donordarah.update', $donordarah->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tgl">Tanggal</label>
            <input type="date" class="form-control" id="tgl" name="tgl" value="{{ old('tgl', $donordarah->tgl) }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Y" {{ old('status', $donordarah->status) == 'Y' ? 'selected' : '' }}>Ya</option>
                <option value="T" {{ old('status', $donordarah->status) == 'T' ? 'selected' : '' }}>Tidak</option>
                <option value="P" {{ old('status', $donordarah->status) == 'P' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jml_partisipan">Jumlah Partisipan</label>
            <input type="number" class="form-control" id="jml_partisipan" name="jml_partisipan" value="{{ old('jml_partisipan', $donordarah->jml_partisipan) }}" required>
        </div>

        <div class="form-group">
            <label for="jml_donor">Jumlah Donor</label>
            <input type="number" class="form-control" id="jml_donor" name="jml_donor" value="{{ old('jml_donor', $donordarah->jml_donor) }}" required>
        </div>

        <div class="form-group">
            <label for="id_user">Host</label>
            <select class="form-control select2" id="id_user" name="id_user" data-placeholder="Pilih Host" required>
                <option value="" disabled>Pilih Host</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('id_user', $donordarah->id_user) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="mitra">Mitra</label>
            <select class="form-control select2" id="mitra" name="id_mitra" data-placeholder="Pilih Mitra" required>
                <option value="" disabled>Pilih Mitra</option>
                @foreach ($mitras as $mitra)
                    <option value="{{ $mitra->id }}" {{ old('id_mitra', $donordarah->id_mitra) == $mitra->id ? 'selected' : '' }}>{{ $mitra->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="partisipan">Partisipan</label>
            <select class="form-control select2" id="partisipan" name="partisipan[]" data-placeholder="Pilih Partisipan" multiple="multiple" required>
                @foreach ($partisipans as $partisipan)
                    <option value="{{ $partisipan->id }}" {{ in_array($partisipan->id, old('partisipan', $donordarah->partisipans->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $partisipan->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="dokumentasi">Dokumentasi</label>
            <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi">
            @if ($donordarah->dokumentasi)
                <br>
                <a href="{{ Storage::url('public/dokumentasi/' . $donordarah->dokumentasi) }}" target="_blank">Lihat Dokumentasi Saat Ini</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('donordarah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#id_user').select2({
                placeholder: $('#id_user').data('placeholder'),
                allowClear: true
            });
            $('#mitra').select2({
                placeholder: $('#mitra').data('placeholder'),
                allowClear: true
            });
            $('#partisipan').select2({
                placeholder: $('#partisipan').data('placeholder'),
                allowClear: true
            });
        });
    </script>
@endpush
