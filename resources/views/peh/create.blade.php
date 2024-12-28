@extends('layouts.admin')

@section('main-content')
<div class="d-flex align-items-center mb-4">
    <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
        <i class="fas fa-lg fa-arrow-left"></i>
    </a>
    <h1 class="h3 text-gray-800">{{ __('PEH') }}</h1>
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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Tambah Data</h4>
    </div>
    <div class="card-body">
    <form action="{{ route('peh.store') }}" method="POST">
    @csrf
        <div class="form-group">
            <label for="tgl">Tanggal
            <input type="date" class="form-control" id="tgl" name="tgl">
            </label>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="spesialisasi">Spesialisasi</label>
                    <select name="spesialisasi" class="form-control" id="spesialisasi" onchange="filterDokter()">
                        <option value="">Pilih Spesialisasi</option>
                        <option value="THT-KL" {{ $spesialisasi == 'THT-KL' ? 'selected' : '' }}>THT-KL</option>
                        <option value="Anak" {{ $spesialisasi == 'Anak' ? 'selected' : '' }}>Anak</option>
                        <option value="Mata" {{ $spesialisasi == 'Mata' ? 'selected' : '' }}>Mata</option>
                        <option value="Orthopedi" {{ $spesialisasi == 'Orthopedi' ? 'selected' : '' }}>Orthopedi</option>
                        <option value="Obgyn" {{ $spesialisasi == 'Obgyn' ? 'selected' : '' }}>Obgyn</option>
                        <option value="Bedah Mulut" {{ $spesialisasi == 'Bedah Mulut' ? 'selected' : '' }}>Bedah Mulut</option>
                        <option value="Syaraf" {{ $spesialisasi == 'Syaraf' ? 'selected' : '' }}>Syaraf</option>
                        <option value="Thorax" {{ $spesialisasi == 'Thorax' ? 'selected' : '' }}>Thorax</option>
                        <option value="Digestive" {{ $spesialisasi == 'Digestive' ? 'selected' : '' }}>Digestive</option>
                        <option value="Vaskuler" {{ $spesialisasi == 'Vaskuler' ? 'selected' : '' }}>Vaskuler</option>
                        <option value="Plastik" {{ $spesialisasi == 'Plastik' ? 'selected' : '' }}>Plastik</option>
                        <option value="Urologi" {{ $spesialisasi == 'Urologi' ? 'selected' : '' }}>Urologi</option>
                        <option value="RI" {{ $spesialisasi == 'RI' ? 'selected' : '' }}>RI</option>
                        <option value="Tumor" {{ $spesialisasi == 'Tumor' ? 'selected' : '' }}>Tumor</option>
                        <option value="Bedah Thorax" {{ $spesialisasi == 'Bedah Thorax' ? 'selected' : '' }}>Bedah Thorax</option>
                        <option value="Kardio Vaskuler" {{ $spesialisasi == 'Kardio Vaskuler' ? 'selected' : '' }}>Kardio Vaskuler</option>
                        <option value="Kardio Anak" {{ $spesialisasi == 'Kardio Anak' ? 'selected' : '' }}>Kardio Anak</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="id_dokter">Nama Narasumber</label>
                    <select name="id_dokter" class="form-control select2" id="id_dokter" onchange="updateFields()">
                        <option value="">Pilih Narasumber</option>
                        @foreach ($dokter as $item)
                        <option value="{{ $item->id }}" 
                        data-spesialisasi="{{ $item->spesialisasi }}" 
                        data-subdivisi="{{ $item->subdivisi }}"
                        data-nipnib="{{ $item->nipnib }}">
                        {{ $item->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
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
            <label for="tema">Tema PEH</label>
            <input type="text" class="form-control" id="tema" name="tema" placeholder="Tema">
        </div>
        <div class="form-group">
            <label for="status">Status
            <select name="status" class="form-control">
                <option value="Y">Y (Ya)</option>
                <option value="T">T (Tidak)</option>
                <option value="P">Terjadwal</option>
            </select>
            </label>
        </div>
        <div class="form-group">
            <label for="id_user">Tim Promkes
            <select name="id_user" class="form-control select2">
                @foreach ($user as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
            </label>
        </div>
        <div class="form-group">
            <label for="jml_penonton">Viewers
            <input type="number" class="form-control" id="jml_penonton" name="jml_penonton" placeholder="Jumlah Penonton">
            </label>
        </div>
        <div class="px-3">
            <button class="btn btn-success">Tambah</button>
            <a class="btn btn-warning" href="{{url('/peh')}}">Kembali</a>
        </div>
    </form>
    <script>
        function updateFields() {
            var select = document.getElementById('id_dokter');
            var selectedOption = select.options[select.selectedIndex];
            document.getElementById('nipnib').value = selectedOption.getAttribute('data-nipnib');
            document.getElementById('spesialisasi_dokter').value = selectedOption.getAttribute('data-spesialisasi');
            document.getElementById('subdivisi').value = selectedOption.getAttribute('data-subdivisi');
        }

        function filterDokter() {
            var spesialisasi = document.getElementById('spesialisasi').value;
            var url = new URL(window.location.href);
            url.searchParams.set('spesialisasi', spesialisasi);
            window.location.href = url.href;
        }
    </script>
    </div>
</div>
@endsection
