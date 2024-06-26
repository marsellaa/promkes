@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-2 text-gray-800">Kunjungan Mitra</h1>
    <p class="mb-4">Tabel Kunjungan Mitra</p>
    @if (Auth::user()->id_role === 1)
        <a href="{{ route('kjmitra.create') }}" class="btn btn-primary m-1 mb-2">Tambah</a>
    @endif

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Mitra</th>
                    <th>Tujuan</th>
                    <th>Host</th>
                    <th>Dokumentasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kjmitras as $kjmitra)
                <tr>
                    <td>{{ $kjmitra->id }}</td>
                    <td>{{ $kjmitra->tgl }}</td>
                    <td>{{ $kjmitra->mitra->nama }}</td>
                    <td>{{ $kjmitra->tujuan }}</td>
                    <td>{{ $kjmitra->user->name }}</td>
                    <td>
                        @if ($kjmitra->dokumentasi)
                            <a href="{{ asset('uploads/kjmitra_dokumentasi/' . $kjmitra->dokumentasi) }}" target="_blank">Lihat</a>
                        @else
                            Tidak ada
                        @endif
                    </td>
                    <td>
                        @if (Auth::user()->id === $kjmitra->id_user || Auth::user()->id_role === 1)
                            <a href="{{ route('kjmitra.edit', $kjmitra->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('kjmitra.destroy', $kjmitra->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger show_confirm" data-nama="{{ $kjmitra->tujuan }}">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.show_confirm').click(function(event){
                var form = $(this).closest("form");
                var nama = $(this).data("nama");
                event.preventDefault();
                swal({
                    title: `Anda yakin ingin menghapus data ${nama}?`,
                    text: "Data yang dihapus akan hilang selamanya.",
                    icon: "warning",
                    buttons: true,
                    showCancelButton:true,
                    confirmButtonText: "Hapus",
                    closeOnConfirm: false,
                    dangerMode: true,
                },
                function(){
                    form.submit();
                });
            });
                
            });

    </script>
    @if(session('success'))
        <script>
            swal({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                button: "OK",
            });
        </script>
    @endif
@endpush
