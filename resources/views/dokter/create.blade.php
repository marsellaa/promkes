@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Dokter</h1>

    <form action="{{ route('dokter.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id">Id Dokter</label>
            <input type="number" name="id" class="form-control" id="id" value="{{ old('id') }}" required min="1" max="999" oninput="this.value=this.value.slice(0,3)">
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
        </div>
        <div class="form-group">
            <label for="nipnib">NIP/NIB</label>
            <input type="number" name="nipnib" class="form-control" id="nipnib" value="{{ old('nipnib') }}" required oninput="this.value=this.value.slice(0,18)">
        </div>
        <div class="form-group">
            <label for="subdivisi">Subdivisi</label>
            <input type="number" name="subdivisi" class="form-control" id="subdivisi" value="{{ old('subdivisi') }}" oninput="this.value=this.value.slice(0,2)">
        </div>
        <div class="form-group">
            <label for="spesialisasi">Spesialisasi</label>
            <select name="spesialisasi" class="form-control" id="spesialisasi" required>
                <option value="">Pilih Spesialisasi</option>
                <option value="THT-KL" {{ old('spesialisasi') == 'THT-KL' ? 'selected' : '' }}>THT-KL</option>
                <option value="Anak" {{ old('spesialisasi') == 'Anak' ? 'selected' : '' }}>Anak</option>
                <option value="Mata" {{ old('spesialisasi') == 'Mata' ? 'selected' : '' }}>Mata</option>
                <option value="Orthopedi" {{ old('spesialisasi') == 'Orthopedi' ? 'selected' : '' }}>Orthopedi</option>
                <option value="Obgyn" {{ old('spesialisasi') == 'Obgyn' ? 'selected' : '' }}>Obgyn</option>
                <option value="Bedah Mulut" {{ old('spesialisasi') == 'Bedah Mulut' ? 'selected' : '' }}>Bedah Mulut</option>
                <option value="Syaraf" {{ old('spesialisasi') == 'Syaraf' ? 'selected' : '' }}>Syaraf</option>
                <option value="Thorax" {{ old('spesialisasi') == 'Thorax' ? 'selected' : '' }}>Thorax</option>
                <option value="Digestive" {{ old('spesialisasi') == 'Digestive' ? 'selected' : '' }}>Digestive</option>
                <option value="Vaskuler" {{ old('spesialisasi') == 'Vaskuler' ? 'selected' : '' }}>Vaskuler</option>
                <option value="Plastik" {{ old('spesialisasi') == 'Plastik' ? 'selected' : '' }}>Plastik</option>
                <option value="Urologi" {{ old('spesialisasi') == 'Urologi' ? 'selected' : '' }}>Urologi</option>
                <option value="RI" {{ old('spesialisasi') == 'RI' ? 'selected' : '' }}>RI</option>
                <option value="Tumor" {{ old('spesialisasi') == 'Tumor' ? 'selected' : '' }}>Tumor</option>
                <option value="Bedah Thorax" {{ old('spesialisasi') == 'Bedah Thorax' ? 'selected' : '' }}>Bedah Thorax</option>
                <option value="Kardio Vaskuler" {{ old('spesialisasi') == 'Kardio Vaskuler' ? 'selected' : '' }}>Kardio Vaskuler</option>
                <option value="Kardio Anak" {{ old('spesialisasi') == 'Kardio Anak' ? 'selected' : '' }}>Kardio Anak</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
