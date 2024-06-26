@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4">
        <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
            <i class="fas fa-lg fa-arrow-left"></i>
        </a>
        <h1 class="h3 text-gray-800">{{ __('Tambah Feedback') }}</h1>
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

    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tgl">Tanggal Survey</label>
            <input type="date" class="form-control" id="tgl" name="tgl" required>
        </div>
        <div class="form-group">
            <label for="nama_pasien">Nama Pasien</label>
            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
        </div>
        <div class="form-group">
            <label for="akun_ig">Akun IG</label>
            <input type="text" class="form-control" id="akun_ig" name="akun_ig">
        </div>
        <div class="form-group">
            <label for="akun_fb">Akun FB</label>
            <input type="text" class="form-control" id="akun_fb" name="akun_fb">
        </div>
        <div class="form-group">
            <label for="akun_tiktok">Akun Tiktok</label>
            <input type="text" class="form-control" id="akun_tiktok" name="akun_tiktok">
        </div>
        <div class="form-group">
            <label for="masukan">Masukan/Saran</label>
            <textarea class="form-control" id="masukan" name="masukan" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="id_user">Tim Promkes</label>
            <select class="form-control select2" id="id_user" name="id_user" data-placeholder="Pilih Tim Promkes" required>
                <option value="" disabled selected>Pilih Tim Promkes</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        @for ($i = 0; $i < 10; $i++)
            <div class="form-group">
                <label for="pertanyaan_{{ $i }}">Pertanyaan {{ $i + 1 }}</label>
                <select class="form-control" id="pertanyaan_{{ $i }}" name="pertanyaan[]">
                    <option value="">Pilih Pertanyaan</option>
                    @foreach($pertanyaans as $pertanyaan)
                        <option value="{{ $pertanyaan->id }}">{{ $pertanyaan->pertanyaan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jawaban_{{ $i }}">Jawaban {{ $i + 1 }}</label>
                <input type="text" class="form-control" id="jawaban_{{ $i }}" name="jawaban[]">
            </div>
        @endfor

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
