@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4">
        <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
            <i class="fas fa-lg fa-arrow-left"></i>
        </a>
        <h1 class="h3 text-gray-800">{{ __('Tambah Video') }}</h1>
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

    <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="tgl">Tanggal</label>
            <input type="date" class="form-control" id="tgl" name="tgl" required>
        </div>

        <div class="form-group">
            <label for="jenis_info">Jenis Informasi</label>
            <input type="text" class="form-control" id="jenis_info" name="jenis_info" required>
        </div>

        <div class="form-group">
            <label for="tema">Tema</label>
            <input type="text" class="form-control" id="tema" name="tema" required>
        </div>

        <div class="form-group">
            <label for="id_dokter">Narasumber</label>
            <select class="form-control select2" id="id_dokter" name="id_dokter" onchange="updateFields()" required>
                <option value="" disabled selected>Pilih Narasumber</option>
                @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}" data-spesialisasi="{{ $dokter->spesialisasi }}" data-subdivisi="{{ $dokter->subdivisi }}">{{ $dokter->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="spesialisasi">Spesialisasi</label>
            <input type="text" class="form-control" id="spesialisasi" readonly>
        </div>

        <div class="form-group">
            <label for="subdivisi">Unit Kerja</label>
            <input type="text" class="form-control" id="subdivisi" readonly>
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

        <div class="form-group">
            <label for="dokumentasi">Dokumentasi</label>
            <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('video.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        function updateFields() {
            var select = document.getElementById('id_dokter');
            var selectedOption = select.options[select.selectedIndex];

            var spesialisasi = selectedOption.getAttribute('data-spesialisasi');
            var subdivisi = selectedOption.getAttribute('data-subdivisi');

            document.getElementById('spesialisasi').value = spesialisasi;
            document.getElementById('subdivisi').value = subdivisi;
        }
    </script>
@endpush
