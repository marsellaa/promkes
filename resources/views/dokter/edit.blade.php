@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Edit Data Dokter</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id">Id Dokter</label>
            <input type="number" name="id" class="form-control" id="id" value="{{ old('id', $dokter->id) }}" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', $dokter->nama) }}" required>
        </div>
        <div class="form-group">
            <label for="nipnib">NIP/NIB</label>
            <input type="text" name="nipnib" class="form-control" id="nipnib" value="{{ old('nipnib', $dokter->nipnib) }}" required>
        </div>
        <div class="form-group">
            <label for="subdivisi">Subdivisi</label>
            <input type="text" name="subdivisi" class="form-control" id="subdivisi" value="{{ old('subdivisi', $dokter->subdivisi) }}">
        </div>
        <div class="form-group">
            <label for="spesialisasi">Spesialisasi</label>
            <select name="spesialisasi" class="form-control" id="spesialisasi" required>
                <option value="">Pilih Spesialisasi</option>
                <option value="THT-KL" {{ old('spesialisasi', $dokter->spesialisasi) == 'THT-KL' ? 'selected' : '' }}>THT-KL</option>
                <option value="Anak" {{ old('spesialisasi', $dokter->spesialisasi) == 'Anak' ? 'selected' : '' }}>Anak</option>
                <option value="Mata" {{ old('spesialisasi', $dokter->spesialisasi) == 'Mata' ? 'selected' : '' }}>Mata</option>
                <option value="Orthopedi" {{ old('spesialisasi', $dokter->spesialisasi) == 'Orthopedi' ? 'selected' : '' }}>Orthopedi</option>
                <option value="Obgyn" {{ old('spesialisasi', $dokter->spesialisasi) == 'Obgyn' ? 'selected' : '' }}>Obgyn</option>
                <option value="Bedah Mulut" {{ old('spesialisasi', $dokter->spesialisasi) == 'Bedah Mulut' ? 'selected' : '' }}>Bedah Mulut</option>
                <option value="Syaraf" {{ old('spesialisasi', $dokter->spesialisasi) == 'Syaraf' ? 'selected' : '' }}>Syaraf</option>
                <option value="Thorax" {{ old('spesialisasi', $dokter->spesialisasi) == 'Thorax' ? 'selected' : '' }}>Thorax</option>
                <option value="Digestive" {{ old('spesialisasi', $dokter->spesialisasi) == 'Digestive' ? 'selected' : '' }}>Digestive</option>
                <option value="Vaskuler" {{ old('spesialisasi', $dokter->spesialisasi) == 'Vaskuler' ? 'selected' : '' }}>Vaskuler</option>
                <option value="Plastik" {{ old('spesialisasi', $dokter->spesialisasi) == 'Plastik' ? 'selected' : '' }}>Plastik</option>
                <option value="Urologi" {{ old('spesialisasi', $dokter->spesialisasi) == 'Urologi' ? 'selected' : '' }}>Urologi</option>
                <option value="RI" {{ old('spesialisasi', $dokter->spesialisasi) == 'RI' ? 'selected' : '' }}>RI</option>
                <option value="Tumor" {{ old('spesialisasi', $dokter->spesialisasi) == 'Tumor' ? 'selected' : '' }}>Tumor</option>
                <option value="Bedah Thorax" {{ old('spesialisasi', $dokter->spesialisasi) == 'Bedah Thorax' ? 'selected' : '' }}>Bedah Thorax</option>
                <option value="Kardio Vaskuler" {{ old('spesialisasi', $dokter->spesialisasi) == 'Kardio Vaskuler' ? 'selected' : '' }}>Kardio Vaskuler</option>
                <option value="Kardio Anak" {{ old('spesialisasi', $dokter->spesialisasi) == 'Kardio Anak' ? 'selected' : '' }}>Kardio Anak</option>
            </select>
        </div>
        <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="form-control" id="status" required>
            <option value="Aktif" {{ old('status', $dokter->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Nonaktif" {{ old('status', $dokter->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
        <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection