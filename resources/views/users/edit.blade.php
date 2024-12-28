@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4">
        <a href="#" onclick="history.back();" class="btn btn-link text-primary align-middle pl-0 mb-2 mr-2">
            <i class="fas fa-lg fa-arrow-left"></i>
        </a>
        <h1 class="h3 text-gray-800">{{ __('Akun') }}</h1>
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
            <h4 class="m-0 font-weight-bold text-primary">Tambah Akun</h4>
        </div>
        <div class="card-body">
        <form action="{{route('akun.update',$akun->id)}}" method="POST">
        @method("PUT")
            @csrf
        <div class="px-3">
            <div class="form-group">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="{{$akun->name}}" >
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="{{$akun->email}}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" value="{{$akun->password}}">
                </div>
            </div>
            <div class="form-group m-3">
                <label for="">Role Akun
                    <select name="id_role" id="id_role" class="form-control">
                        @if(Auth::user()->id_role === 1)
                        <option value="1" {{ $akun->id_role == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $akun->id_role == 2 ? 'selected' : '' }}>Tim Promkes</option>
                        <option value="2" {{ $akun->id_role == 3 ? 'selected' : '' }}>Pimpinan</option>
                        @endif
                        <!-- @if(Auth::user()->id_role === 4)
                        <option value="1" {{ $akun->id_role == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $akun->id_role == 2 ? 'selected' : '' }}>User</option>
                        <option value="3" {{ $akun->id_role == 3 ? 'selected' : '' }}>Monitoring</option>
                        @endif -->
                    </select>
                </label>
            </div>
            <div class="form-group">
                <label for="phone_number" class="col-sm-3 col-form-label">No. Telepon</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone_number" value="{{$akun->phone_number}}">
                </div>
            </div>
        <div class="px-3">
            <button class="btn btn-success">Update</button>
            <a class="btn btn-warning" href="{{route('akun.index')}}">Kembali</a>
        </div>
    </form>
@endsection
