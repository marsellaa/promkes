@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4 justify-content-between">
        <div>
            <h1 class="h3 text-gray-800">Kelola Akun Pengguna</h1>
            <p class="mb-4">Tabel Daftar Akun</p>
        </div>
        @if (Auth::user()->id_role === 1 || Auth::user()->id_role === 4)
            <div>
                <a href="{{ route('akun.create') }}" class="btn btn-primary mb-4">Tambah Akun</a>
            </div>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Nomor Telephone</th>
                    <th colspan="2">Edit | Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akun as $item)
                @if (Auth::user()->id_role === 1 && $item->id_role >=2)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->role->nama}}</td>
                    <td>{{$item->phone_number}}</td>
                    <td>
                        @if (Auth::user()->id === $item->id_user || Auth::user()->id_role === 1 ||Auth::user()->id_role === 4)
                            <a href="{{ route('akun.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('akun.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('delete')
                                    <button type="submit" class="btn btn-danger show_confirm" data-nama="{{ $item->name }}">Hapus</button>
                            </form>
                            @endif
                    </td>
                </tr>
                @elseif (Auth::user()->id_role === 4)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->role->nama}}</td>
                        <td>{{$item->phone_number}}</td>
                        <td>
                            @if (Auth::user()->id === $item->id_user || Auth::user()->id_role === 1 ||Auth::user()->id_role === 4)
                                <a href="{{ route('akun.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('akun.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('delete')
                                        <button type="submit" class="btn btn-danger show_confirm" data-nama="{{ $item->name }}">Hapus</button>
                                </form>
                                @endif
                        </td>
                    </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Include SweetAlert JS -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.show_confirm').click(function(event){
                var form = $(this).closest("form");
                var nama = $(this).data("nama");
                event.preventDefault();
                Swal.fire({
                    title: `Anda yakin ingin menghapus data ${nama}?`,
                    text: "Data yang dihapus akan hilang selamanya.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>
    @endif
@endpush