@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1 class="h3 text-gray-800">PEH EDUKASI HOESIN'ERS</h1>
            <p class="mb-4">Tabel Kegiatan PEH</p>
        </div>
        @if (Auth::user()->id_role === 1 || Auth::user()->id_role === 3)
            <div class="d-flex">
                <form id="cetakForm">
                    <input type="date" name="start_date"
                        value="{{ request()->get('start_date', date('Y-m-d')) }}" class="form-control"
                        style="width: 200px;">
                    <div class="mx-3">-</div>
                    <input type="date" name="end_date"
                        value="{{ request()->get('end_date', date('Y-m-d')) }}" class="form-control"
                        style="width: 200px;">

                    <button id="cetakpeh" type="submit" class="btn btn-success mb-4 cetak-button">
                        <i class="fa fa-print"></i> Cetak</button>
                </form>
            </div>
        @endif
    </div>

    @if (Auth::user()->id_role === 1)
        <div style="float: right">
            <a href="{{ route('peh.create') }}" class="btn btn-primary mb-4">Tambah</a>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam</th> <!-- Kolom Jam -->
                    <th>Nama Narasumber</th>
                    <th>Narasumber Pengganti</th> <!-- Kolom baru -->
                    <th>Spesialisasi</th>
                    <th>Tema</th>
                    <th>Status</th>
                    <th>Tim Promkes</th>
                    <th>Host Luar</th> <!-- Kolom baru -->
                    @if(Auth::user()->id_role === 1)
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($peh as $item)
                <tr>
                    <td>{{ $item->tgl }}</td>
                    <td>{{ $item->jam ?? 'Tidak Diketahui' }}</td> <!-- Menampilkan Jam -->
                    <td>{{ $item->dokter->nama }}</td>
                    <td>{{ $item->dokterPengganti->nama ?? 'Tidak Ada' }}</td> <!-- Menampilkan narasumber pengganti -->
                    <td>{{ $item->dokter->spesialisasi }}</td>
                    <td>{{ $item->tema }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->host ?? 'Tidak Ada' }}</td> <!-- Menampilkan host -->
                    @if(Auth::user()->id_role === 1)
                    <td>
                        @if (Auth::user()->id === $item->id_user || Auth::user()->id_role === 1)
                            <div class="d-flex">
                                <a href="{{ route('peh.edit', $item->id) }}" class="btn btn-warning edit-button">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </div>
                        @endif
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


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('cetakForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const startDate = document.querySelector('input[name="start_date"]').value;
        const endDate = document.querySelector('input[name="end_date"]').value;

        const pdfUrl = `{{ route('peh.downloadPdf') }}?start_date=${startDate}&end_date=${endDate}`;

        window.location.href = pdfUrl;
    });
});
    </script>
@endpush
