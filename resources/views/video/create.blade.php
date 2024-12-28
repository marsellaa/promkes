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
            <label for="tgl">Tanggal
                <input type="date" class="form-control" id="tgl" name="tgl" required>
            </label>
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
            <div class="row">
                <div class="col-md-6">
                    <label for="id_dokter">Nama Narasumber</label>
                    <select name="id_dokter" class="form-control select2" id="id_dokter" onchange="updateFields()">
                        <option value="">Pilih Narasumber</option>
                        @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->id }}" 
                        data-spesialisasi="{{ $dokter->spesialisasi }}" 
                        data-subdivisi="{{ $dokter->subdivisi }}"
                        data-nipnib="{{ $dokter->nipnib }}">
                        {{ $dokter->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="nipnib">NIP/NIB</label>
                    <input type="text" class="form-control" id="nipnib" readonly>
                </div>
            </div>
        </div>
            


        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="spesialisasi_dokter">Spesialisasi</label>
                    <input type="text" class="form-control" id="spesialisasi_dokter" readonly>
                </div>
                <div class="col-md-6">
                    <label for="subdivisi">Unit Kerja</label>
                    <input type="text" class="form-control" id="subdivisi" readonly>
                </div>
            </div>
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
        function updateFields() {
            var select = document.getElementById('id_dokter');
            var selectedOption = select.options[select.selectedIndex];
            document.getElementById('nipnib').value = selectedOption.getAttribute('data-nipnib');
            document.getElementById('spesialisasi_dokter').value = selectedOption.getAttribute('data-spesialisasi');
            document.getElementById('subdivisi').value = selectedOption.getAttribute('data-subdivisi');
        }
    </script>
@endpush
