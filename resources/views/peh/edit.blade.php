@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
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

    <form action="{{ route('peh.update', $peh->id) }}" method="POST">
        @csrf
        @method("PUT")
        <div class="px-3">
            <div class="form-group">
                <label for="tgl">Tanggal
                <input type="date" class="form-control" id="tgl" name="tgl" value="{{ $peh->tgl }}">
                </label>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="id_dokter">Nama Narasumber</label>
                        <select name="id_dokter" class="form-control select2" id="id_dokter" onchange="updateFields()">
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
                    <div class="col-md-6">
                        <label for="nipnib">NIP/NIB</label>
                        <input type="text" class="form-control" id="nipnib" value="{{ $peh->dokter->nipnib }}" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="spesialisasi">Spesialisasi</label>
                        <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" value="{{ $peh->dokter->spesialisasi }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="subdivisi">Unit Kerja</label>
                        <input type="text" class="form-control" id="subdivisi" name="subdivisi" value="{{ $peh->dokter->subdivisi }}" readonly>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="tema">Tema PEH</label>
                <input type="text" class="form-control" id="tema" placeholder="Tema" name="tema" value="{{ $peh->tema }}">
            </div>

            <div class="form-group">
                <label for="status">Status
                <select name="status" class="form-control" id="status">
                    <option value="Y" {{ $peh->status == 'Y' ? 'selected' : '' }}>Y (Ya)</option>
                    <option value="T" {{ $peh->status == 'T' ? 'selected' : '' }}>T (Tidak)</option>
                    <option value="P" {{ $peh->status == 'P' ? 'selected' : '' }}>Terjadwal</option>
                </select>
                </label>
            </div>

            <div class="form-group">
                <label for="id_user">Tim Promkes
                <select name="id_user" class="form-control select2" id="id_user">
                    @foreach ($user as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $peh->id_user ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                </label>
            </div>

            <div class="form-group">
                <label for="jml_penonton">Viewers
                <input type="number" class="form-control" id="jml_penonton" placeholder="Jumlah Penonton" name="jml_penonton" value="{{ $peh->jml_penonton }}">
                </label>
            </div>
        </div>
        
        <div class="px-3">
            <div class="form-group m-3">
                <button class="btn btn-success">Simpan</button>
                <a class="btn btn-warning" href="{{ url('/peh') }}">Kembali</a>
            </div>
        </div>
    </form>

    <script>
        function updateFields() {
            var select = document.getElementById('id_dokter');
            var selectedOption = select.options[select.selectedIndex];

            var spesialisasi = selectedOption.getAttribute('data-spesialisasi');
            var subdivisi = selectedOption.getAttribute('data-subdivisi');
            var nipnib = selectedOption.getAttribute('data-nipnib');

            document.getElementById('spesialisasi').value = spesialisasi;
            document.getElementById('subdivisi').value = subdivisi;
            document.getElementById('nipnib').value = nipnib;
        }

        // Initial call to populate fields when the page is loaded
        document.addEventListener('DOMContentLoaded', function() {
            updateFields();
        });
    </script>
@endsection
