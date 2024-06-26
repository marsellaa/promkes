@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center mb-4 justify-content-between">
        <div>
            <h1 class="h3 text-gray-800">PEH EDUKASI HOESIN'ERS</h1>
            <p class="mb-4">Tabel Kegiatan PEH</p>
        </div>
        @if (Auth::user()->id_role === 1)
            <div>
                <a href="{{ route('peh.create') }}" class="btn btn-primary mb-4">Tambah</a>
                <a href="{{ route('peh.downloadPdf') }}" class="btn btn-secondary mb-4">
                    <i class="fas fa-download"></i> Download PDF
                </a>
            </div>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Narasumber</th>
                    <th>Spesialisasi</th>
                    <th>Unit Kerja</th>
                    <th>Tema</th>
                    <th>Status</th>
                    <th>Host</th>
                    <th>Edit | Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peh as $item)
                <tr>
                    <td>{{ $item->tgl }}</td>
                    <td>{{ $item->dokter->nama }}</td>
                    <td>{{ $item->dokter->spesialisasi }}</td>
                    <td>{{ $item->dokter->subdivisi }}</td>
                    <td>{{ $item->tema }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                        @if (Auth::user()->id === $item->id_user || Auth::user()->id_role === 1)
                            <a href="{{ route('peh.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('peh.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger show_confirm" data-nama="{{ $item->tema }}">Hapus</button>
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
