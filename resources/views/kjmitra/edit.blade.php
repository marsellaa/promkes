@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4">
        <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
            <i class="fas fa-lg fa-arrow-left"></i>
        </a>
        <h1 class="h3 text-gray-800">{{ __('Edit Kunjungan Mitra') }}</h1>
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

    <form action="{{ route('kjmitra.update', $kjmitra->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tgl">Tanggal</label>
            <input type="date" class="form-control" id="tgl" name="tgl" value="{{ $kjmitra->tgl }}" required>
        </div>

        <div class="form-group">
            <label for="id_mitra">Mitra</label>
            <select class="form-control select2" id="id_mitra" name="id_mitra" required>
                @foreach ($mitras as $mitra)
                    <option value="{{ $mitra->id }}" {{ $kjmitra->id_mitra == $mitra->id ? 'selected' : '' }}>{{ $mitra->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tujuan">Tujuan</label>
            <textarea class="form-control" id="tujuan" name="tujuan" rows="3" required>{{ $kjmitra->tujuan }}</textarea>
        </div>

        <div class="form-group">
            <label for="id_user">Host</label>
            <select class="form-control select2" id="id_user" name="id_user" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $kjmitra->id_user == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="dokumentasi">Dokumentasi</label>
            <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi">
            @if ($kjmitra->dokumentasi)
                <p>Dokumentasi saat ini: <a href="{{ asset('uploads/kjmitra_dokumentasi/' . $kjmitra->dokumentasi) }}" target="_blank">{{ $kjmitra->dokumentasi }}</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kjmitra.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
