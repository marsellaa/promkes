@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Informasi dan Komplain</h1>
    <p class="mb-4">Tabel Data Informasi dan Komplain</p>
    @if (Auth::user()->id_role === 1)
        <a href="{{ route('infodankomplain.create') }}" class="btn btn-primary m-1 mb-2">Tambah</a>
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
                    <th>Jenis Berita</th>
                    <th>Media Sosial</th>
                    <th>Isi Berita</th>
                    <th>Kelompok</th>
                    <th>Tim Promkes</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($infoKomplains as $infoKomplain)
                <tr>
                    <td>{{ $infoKomplain->id }}</td>
                    <td>{{ $infoKomplain->tgl }}</td>
                    <td>{{ $infoKomplain->jenis_berita }}</td>
                    <td>{{ $infoKomplain->media_sosial }}</td>
                    <td style="white-space: normal !important; word-wrap: break-word; word-break: break-all;">{{ $infoKomplain->isi_berita }}</td>
                    <td>{{ $infoKomplain->kelompok }}</td>
                    <td>{{ $infoKomplain->user->name }}</td>
                    <td>
                        @if(Auth::user()->id === $infoKomplain->id_user || Auth::user()->id_role === 1)
                            <a href="{{ route('infodankomplain.edit', $infoKomplain->id) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('infodankomplain.destroy', $infoKomplain->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger show_confirm" data-nama="{{ $infoKomplain->jenis_berita }}">Hapus</button>
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
                    title: `Anda yakin ingin menghapus data "${nama}"?`,
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
