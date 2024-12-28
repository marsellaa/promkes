@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4">
        <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
            <i class="fas fa-lg fa-arrow-left"></i>
        </a>
        <h1 class="h3 text-gray-800">{{ __('Tambah Health Talk') }}</h1>
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
            <form action="{{ route('healthtalk.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tgl">Tanggal</label>
                    <input type="date" class="form-control" id="tgl" name="tgl">
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
                    <label for="tema_ht">Tema Health Talk</label>
                    <input type="text" class="form-control" id="tema_ht" name="tema_ht" placeholder="Tema">
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="Y">Y (Ya)</option>
                        <option value="T">T (Tidak)</option>
                        <option value="P">Terjadwal</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_user">Tim Promkes</label>
                    <select name="id_user" id="id_user" class="form-control select2">
                        <option value="" disabled selected>Pilih Tim Promkes</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="mitras">Mitra</label>
                    <select name="mitras[]" id="mitras" class="form-control select2" multiple="multiple">
                        @foreach ($mitras as $mitra)
                            <option value="{{ $mitra->id }}">
                                {{ $mitra->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="partisipans">Partisipan</label>
                    <select name="partisipans[]" id="partisipans" class="form-control select2" multiple="multiple">
                        @foreach ($partisipans as $partisipan)
                            <option value="{{ $partisipan->id }}">
                                {{ $partisipan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jml_penonton">Viewers</label>
                    <input type="number" class="form-control" id="jml_penonton" name="jml_penonton" placeholder="Jumlah Penonton">
                </div>

                <div class="px-3">
                    <button class="btn btn-success">Tambah</button>
                    <a class="btn btn-warning" href="{{ url('/healthtalk') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>

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

@endsection
