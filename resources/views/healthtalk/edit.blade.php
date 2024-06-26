@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4">
        <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
            <i class="fas fa-lg fa-arrow-left"></i>
        </a>
        <h1 class="h3 text-gray-800">{{ __('Edit Health Talk') }}</h1>
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

    <form action="{{ route('healthtalk.update', $healthtalk->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="px-3">
            <div class="form-group m-3">
                <label for="tgl">Tanggal 
                    <input type="date" class="form-control " id="tgl" name="tgl" value="{{ $healthtalk->tgl }}">
                </label>
            </div>

        <div class="form-group">
                <label for="id_dokter" class="col-sm-3 col-form-label">Nama Narasumber</label>
                <div class="col-sm-9">
                    <select name="id_dokter" class="form-control select2" id="id_dokter" onchange="updateFields()">
                        <option value="" disabled selected>Pilih Narasumber</option>
                        @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->id }}" 
                                data-spesialisasi="{{ $dokter->spesialisasi }}" 
                                data-subdivisi="{{ $dokter->subdivisi }}"
                                {{ $healthtalk->id_dokter == $dokter->id ? 'selected' : '' }}>
                                {{ $dokter->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="spesialisasi" class="col-sm-3 col-form-label">Spesialisasi</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="spesialisasi" value="{{ $healthtalk->dokter->spesialisasi }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="subdivisi" class="col-sm-3 col-form-label">Unit Kerja</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="subdivisi" value="{{ $healthtalk->dokter->subdivisi }}" readonly>
                </div>
            </div>

        <div class="form-group">
            <label for="tema_ht">Tema Health Talk</label>
            <input type="text" class="form-control" id="tema_ht" name="tema_ht" value="{{ $healthtalk->tema_ht }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Y" {{ $healthtalk->status == 'Y' ? 'selected' : '' }}>Ya</option>
                <option value="T" {{ $healthtalk->status == 'T' ? 'selected' : '' }}>Tidak</option>
                <option value="P" {{ $healthtalk->status == 'P' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        <div class="form-group">
            <label for="mitra" class="col-sm-3 col-form-label" >Mitra</label>
            <select class="form-control select2" id="mitra" name="mitras[]" multiple="multiple" required>
                @foreach ($mitras as $mitra)
                    <option value="{{ $mitra->id }}" {{ in_array($mitra->id, $healthtalk->mitras->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $mitra->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="partisipan"class="col-sm-3 col-form-label">Partisipan</label>
            <select class="form-control select2" id="partisipan" name="partisipans[]" multiple="multiple" required>
                @foreach ($partisipans as $partisipan)
                    <option value="{{ $partisipan->id }}" {{ in_array($partisipan->id, $healthtalk->partisipans->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $partisipan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_user"class="col-sm-3 col-form-label">Tim Promkes</label>
            <select class="form-control select2" id="id_user" name="id_user" required>
                <option value="" disabled selected>Pilih Tim Promkes</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $healthtalk->id_user == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('healthtalk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#id_user').select2({
                placeholder: $('#id_user').data('placeholder'),
                allowClear: true
            });
            $('#mitra').select2({
                placeholder: $('#mitra').data('placeholder'),
                allowClear: true
            });
            $('#partisipan').select2({
                placeholder: $('#partisipan').data('placeholder'),
                allowClear: true
            });
            $('#id_dokter').select2({
                placeholder: $('#id_dokter').data('placeholder'),
                allowClear: true
            });

            // Initialize fields with current values
            updateFields();
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

@endsection
