@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
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
        <form action="{{route('peh.store')}}" method="POST">
        @csrf
        <div class="px-3">
            <div class="form-group m-3">
                <label for="">Tanggal 
                    <input type="date" class="form-control " id="tgl"  name="tgl">
                </label>
            </div>
            <div class="form-group">
                <label for="id_dokter" class="col-sm-3 col-form-label">Nama Narasumber</label>
                <div class="col-sm-9">
                    <select name="id_dokter" class="form-control select2" id="id_dokter" onchange="updateFields()">
                        <option value="">Pilih Narasumber</option>
                        @foreach ($dokter as $item)
                            <option value="{{ $item->id }}" 
                                data-spesialisasi="{{ $item->spesialisasi }}" 
                                data-subdivisi="{{ $item->subdivisi }}">
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="spesialisasi" class="col-sm-3 col-form-label">Spesialisasi</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="spesialisasi" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="subdivisi" class="col-sm-3 col-form-label">Unit Kerja</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="subdivisi" readonly>
                </div>
            </div>
            <div class="form-group m-3">
                <label for="">Tema PEH
                    <input type="text" class="form-control " id="tema" placeholder="Tema" name="tema">
                </label>
            </div>
            
            <div class="form-group m-3">
                <label for="status">Status 
                    <select name="status" class="form-control">
                        <option value="Y">Y (Ya)</option>
                        <option value="T">T (Tidak)</option>
                        <option value="P">P (Pending)</option>
                    </select>
                </label>
            </div>
            <div class="form-group">
                <label for="id_user" class="col-sm-3 col-form-label">Host</label>
                <div class="col-sm-9">
                    <select name="id_user" class="form-control select2">
                        @foreach ($user as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
            <div class="form-group m-3">
                <label for="">Viewers 
                    <input type="number" class="form-control " id="jml_penonton" placeholder="Jumlah Penonton" name="jml_penonton">
                </label>
            </div>
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

            var spesialisasi = selectedOption.getAttribute('data-spesialisasi');
            var subdivisi = selectedOption.getAttribute('data-subdivisi');

            document.getElementById('spesialisasi').value = spesialisasi;
            document.getElementById('subdivisi').value = subdivisi;
        }

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih Narasumber",
                allowClear: true
            });
        });
    </script>
@endsection