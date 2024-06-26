@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-2 text-gray-800">Kerja Sama Non BPJS</h1>
    <p class="mb-4">Tabel Kerja Sama Non BPJS</p>
    @if (Auth::user()->id_role === 1)
        <a href="{{ route('kerjasama_nonbpjs.create') }}" class="btn btn-primary m-1 mb-2">Tambah</a>
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
                    <th>Periode</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Akhir</th>
                    <th>Mitra</th>
                    <th>Jenis Kerjasama</th>
                    <th>Status</th>
                    <th>No. Telp PIC</th>
                    <th>Dokumentasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kerjasamaNonBpjs as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->periode }}</td>
                    <td>{{ $item->tgl_mulai }}</td>
                    <td>{{ $item->tgl_akhir }}</td>
                    <td>{{ $item->mitra->nama }}</td>
                    <td>{{ $item->jenis_kerjasama }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->no_telp_pic }}</td>
                    <td>
                        @if($item->dokumentasi)
                            <a href="{{ asset('storage/' . $item->dokumentasi) }}" target="_blank">Lihat</a>
                        @else
                            Tidak ada dokumentasi
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('kerjasama_nonbpjs.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('kerjasama_nonbpjs.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger show_confirm" data-nama="{{ $item->nama }}">Hapus</button>
                        </form>
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
