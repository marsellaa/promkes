@extends('layouts.admin')

@section('main-content')
<div class="d-flex align-items-center mb-4">
    <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
        <i class="fas fa-lg fa-arrow-left"></i>
    </a>
    <h1 class="h3 text-gray-800">{{ __('Edit PEH') }}</h1>
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
        <h4 class="m-0 font-weight-bold text-primary">Edit Data</h4>
    </div>
    <div class="card-body">
    <form action="{{ route('peh.update', $peh->id) }}" method="POST">
    @csrf
    @method('PUT')
        
    <div class="form-group">
        <h4>Narasumber Utama</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label for="spesialisasi">Spesialisasi</label>
                        <select name="spesialisasi" class="form-control" id="spesialisasi" onchange="filterDokter()">
                            <option value="">Pilih Spesialisasi</option>
                            <option value="THT-KL" {{ $peh->spesialisasi == 'THT-KL' ? 'selected' : '' }}>THT-KL</option>
                            <option value="Anak" {{ $peh->spesialisasi == 'Anak' ? 'selected' : '' }}>Anak</option>
                            <option value="Mata" {{ $peh->spesialisasi == 'Mata' ? 'selected' : '' }}>Mata</option>
                            <option value="Orthopedi" {{ $peh->spesialisasi == 'Orthopedi' ? 'selected' : '' }}>Orthopedi</option>
                            <option value="Obgyn" {{ $peh->spesialisasi == 'Obgyn' ? 'selected' : '' }}>Obgyn</option>
                            <option value="Bedah Mulut" {{ $peh->spesialisasi == 'Bedah Mulut' ? 'selected' : '' }}>Bedah Mulut</option>
                            <option value="Syaraf" {{ $peh->spesialisasi == 'Syaraf' ? 'selected' : '' }}>Syaraf</option>
                            <option value="Thorax" {{ $peh->spesialisasi == 'Thorax' ? 'selected' : '' }}>Thorax</option>
                            <option value="Digestive" {{ $peh->spesialisasi == 'Digestive' ? 'selected' : '' }}>Digestive</option>
                            <option value="Vaskuler" {{ $peh->spesialisasi == 'Vaskuler' ? 'selected' : '' }}>Vaskuler</option>
                            <option value="Plastik" {{ $peh->spesialisasi == 'Plastik' ? 'selected' : '' }}>Plastik</option>
                            <option value="Urologi" {{ $peh->spesialisasi == 'Urologi' ? 'selected' : '' }}>Urologi</option>
                            <option value="RI" {{ $peh->spesialisasi == 'RI' ? 'selected' : '' }}>RI</option>
                            <option value="Tumor" {{ $peh->spesialisasi == 'Tumor' ? 'selected' : '' }}>Tumor</option>
                            <option value="Bedah Thorax" {{ $peh->spesialisasi == 'Bedah Thorax' ? 'selected' : '' }}>Bedah Thorax</option>
                            <option value="Kardio Vaskuler" {{ $peh->spesialisasi == 'Kardio Vaskuler' ? 'selected' : '' }}>Kardio Vaskuler</option>
                            <option value="Kardio Anak" {{ $peh->spesialisasi == 'Kardio Anak' ? 'selected' : '' }}>Kardio Anak</option>
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
                                        data-nipnib="{{ $item->nipnib }}"
                                        {{ $item->id == $peh->id_dokter ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Nama Narasumber dan NIP/NIB -->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="nipnib">NIP/NIB</label>
                        <input type="text" class="form-control" id="nipnib" value="{{ $peh->nipnib }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="spesialisasi_dokter">Spesialisasi</label>
                        <input type="text" class="form-control" id="spesialisasi_dokter" value="{{ $peh->spesialisasi_dokter }}" readonly>
                    </div>
                </div>
            </div>

            <!-- Narasumber Pengganti dan NIP/NIB Pengganti -->
            <div class="form-group">
                <h4>Narasumber Pengganti</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label for="narasumber_pengganti">Nama Narasumber</label>
                        <select name="narasumber_pengganti" class="form-control select2" id="narasumber_pengganti" onchange="updateNarasumberPengganti()">
                            <option value="">Pilih Narasumber Pengganti</option>
                            @foreach ($dokter as $item)
                                <option value="{{ $item->id }}" 
                                        data-spesialisasi="{{ $item->spesialisasi }}" 
                                        data-subdivisi="{{ $item->subdivisi }}"
                                        data-nipnib="{{ $item->nipnib }}"
                                        {{ $item->id == $peh->narasumber_pengganti ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nipnib_pengganti">NIP/NIB</label>
                        <input type="text" class="form-control" id="nipnib_pengganti" value="{{ $peh->nipnib_pengganti }}" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="spesialisasi_pengganti">Spesialisasi</label>
                        <input type="text" class="form-control" id="spesialisasi_pengganti" value="{{ $peh->spesialisasi_pengganti }}" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="tgl">Tanggal</label>
                <input type="date" class="form-control" id="tgl" name="tgl" value="{{ $peh->tgl }}">
            </div>
            <div class="form-group">
                <label for="jam">Jam</label>
                <input type="text" class="form-control" id="jam" name="jam" value="{{ $peh->jam }}" placeholder="Contoh: 14:00 - 14:30">
            </div>

            <div class="form-group">
                <label for="tema">Tema PEH</label>
                <input type="text" class="form-control" id="tema" name="tema" value="{{ $peh->tema }}" placeholder="Tema">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="Y" {{ $peh->status == 'Y' ? 'selected' : '' }}>Terlaksana</option>
                    <option value="T" {{ $peh->status == 'T' ? 'selected' : '' }}>Batal</option>
                    <option value="P" {{ $peh->status == 'P' ? 'selected' : '' }}>Terjadwal</option>
                </select>
            </div>
        
            <div class="form-group">
                <label for="id_user">Tim Promkes</label>
                <select name="id_user" class="form-control select2">
                    @foreach ($user as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $peh->id_user ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="host">Host</label>
                <input type="text" class="form-control" id="host" name="host" value="{{ old('host', $peh->host) }}">
            </div>
            <div class="form-group">
                <label for="jml_penonton">Viewers</label>
                <input type="number" class="form-control" id="jml_penonton" name="jml_penonton" value="{{ old('jml_penonton', $peh->jml_penonton) }}" placeholder="Jumlah Penonton">
            </div>

            <div class="px-3">
                <button class="btn btn-success">Simpan Perubahan</button>
                <a class="btn btn-warning" href="{{url('/peh')}}">Kembali</a>
            </div>
        </form>
    </div>
</div>

<script>
// Fungsi untuk update field berdasarkan pilihan Narasumber
function updateFields() {
    var select = document.getElementById('id_dokter');
    var selectedOption = select.options[select.selectedIndex];
    
    document.getElementById('nipnib').value = selectedOption.getAttribute('data-nipnib');
    document.getElementById('spesialisasi_dokter').value = selectedOption.getAttribute('data-spesialisasi');
}

// Fungsi untuk update field berdasarkan pilihan Narasumber Pengganti
function updateNarasumberPengganti() {
    var select = document.getElementById('narasumber_pengganti');
    var selectedOption = select.options[select.selectedIndex];

    // Mengisi data spesialisasi, nipnib untuk narasumber pengganti
    document.getElementById('nipnib_pengganti').value = selectedOption.getAttribute('data-nipnib') || '';
    document.getElementById('spesialisasi_pengganti').value = selectedOption.getAttribute('data-spesialisasi') || '';
}

// Fungsi untuk filter dokter berdasarkan spesialisasi
function filterDokter() {
    var spesialisasi = document.getElementById('spesialisasi').value;
    var url = new URL(window.location.href);
    url.searchParams.set('spesialisasi', spesialisasi);
    window.location.href = url.href;
}
</script>

@endsection
