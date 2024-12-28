@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-2 text-gray-800">Feedback Pasien</h1>
    <p class="mb-4">Tabel Feedback Pasien</p>
    @if (Auth::user()->id_role === 1)
    <div style="float: right">
        <a href="{{ route('feedback.create') }}" class="btn btn-primary m-1 mb-2">Tambah</a>
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
                    <th>Tanggal Survey</th>
                    <th>Nama Pasien</th>
                    <th>Tim Promkes</th>
                    <th>Akun IG</th>
                    <th>Akun FB</th>
                    <th>Akun Tiktok</th>
                    <th>Masukan/Saran</th>
                    <th>Jawaban</th>
                    @if(Auth::user()->id_role === 1)
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->id }}</td>
                    <td>{{ $feedback->tgl }}</td>
                    <td>{{ $feedback->nama_pasien }}</td>
                    <td>{{ $feedback->user->name }}</td>
                    <td>{{ $feedback->akun_ig }}</td>
                    <td>{{ $feedback->akun_fb }}</td>
                    <td>{{ $feedback->akun_tiktok }}</td>
                    <td>{{ $feedback->masukan }}</td>
                    <td>
                        @foreach($feedback->jawaban as $jawaban)
                            <b>{{ $jawaban->pertanyaan->pertanyaan }}:</b> {{ $jawaban->jawaban }}<br>
                        @endforeach
                    </td>
                    @if(Auth::user()->id_role === 1)
                    <td>
                    <div class="d-flex">
                        <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-warning edit-button">
                                    <i class="fa fa-pencil"></i>
                                </a>
                        <!-- <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger delete-button show_confirm" data-nama="{{ $feedback->nama_pasien }}"><i class="fa fa-trash"></i>
                                    </button>

                        </form> -->
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
