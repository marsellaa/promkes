@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-2 text-gray-800">Video</h1>
    <p class="mb-4">Tabel Video</p>
    @if (Auth::user()->id_role === 1)
        <div style="float: right">
            <a href="{{ route('video.create') }}" class="btn btn-primary mb-4">Tambah</a>
        </div>
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
                    <th>Jenis Informasi</th>
                    <th>Tema</th>
                    <th>Narasumber</th>
                    <th>Spesialisasi</th>
                    <th>Unit Kerja</th>
                    <th>Tim Promkes</th>
                    <th>Dokumentasi</th>
                    @if(Auth::user()->id_role === 1)
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td>{{ $video->id }}</td>
                        <td>{{ $video->tgl }}</td>
                        <td>{{ $video->jenis_info }}</td>
                        <td>{{ $video->tema }}</td>
                        <td>{{ $video->dokter->nama }}</td>
                        <td>{{ $video->dokter->spesialisasi }}</td>
                        <td>{{ $video->dokter->subdivisi }}</td>
                        <td>{{ $video->user->name }}</td>
                        <td>
                            @if($video->dokumentasi)
                                <a href="{{ Storage::url('videos/' . $video->dokumentasi) }}" target="_blank">Lihat</a>
                            @else
                                Tidak ada dokumentasi
                            @endif
                        </td>
                        @if(Auth::user()->id_role === 1)
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning edit-button">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <!-- <form action="{{ route('video.destroy', $video->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger delete-button show_confirm" data-nama="{{ $video->tema }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form> -->
                            </div>
                        </td>
                        @endif
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
