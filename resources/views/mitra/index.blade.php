@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mitra</h1>
    <p class="mb-4">Tabel Data Mitra</p>
    @if (Auth::user()->id_role === 1)
        <a href="{{ route('mitra.create') }}" class="btn btn-primary m-1 mb-2">Tambah</a>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mitra</th>
                    <th>Alamat</th>
                    @if(Auth::user()->id_role === 1)
                        <th>Edit | Delete</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($mitra as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    @if(Auth::user()->id_role === 1)
                    <td>
                        <a href="{{ route('mitra.edit', $item->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('mitra.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger show_confirm" data-nama="{{ $item->nama }}">Hapus</button>
                        </form>
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
