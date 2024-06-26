@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-2 text-gray-800">Health Talk</h1>
    <p class="mb-4">Tabel Data Health Talk</p>
    @if (Auth::user()->id_role === 1)
        <a href="{{ route('healthtalk.create') }}" class="btn btn-primary m-1 mb-2">Tambah</a>
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
                    <th>Tanggal</th>
                    <th>Nama Narasumber</th>
                    <th>Spesialisai</th>
                    <th>Unit Kerja</th>
                    <th>Tema</th>
                    <th>Status</th>
                    <th>Mitra</th>
                    <th>Partisipan</th>
                    <th>Host</th>
                    <th>Edit | Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($healthtalks as $healthtalk)
                <tr>
                    <td>{{ $healthtalk->tgl }}</td>
                    <td>{{ $healthtalk->dokter->nama }}</td>
                    <td>{{ $healthtalk->dokter->spesialisasi }}</td>
                    <td>{{ $healthtalk->dokter->subdivisi }}</td>
                    <td>{{ $healthtalk->tema_ht }}</td>
                    <td>{{ $healthtalk->status }}</td>
                    <td>
                        @foreach($healthtalk->mitras as $mitra)
                            {{ $mitra->nama }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($healthtalk->partisipans as $partisipan)
                            {{ $partisipan->nama }}<br>
                        @endforeach
                    </td>
                    <td>{{ $healthtalk->user->name }}</td>
                    <td>
                        @if (Auth::user()->id === $healthtalk->id_user || Auth::user()->id_role === 1)
                            <a href="{{ route('healthtalk.edit', $healthtalk->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('healthtalk.destroy', $healthtalk->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger show_confirm" data-nama="{{ $healthtalk->tema_ht }}">Hapus</button>
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
