<!DOCTYPE html>
<html>
<head>
    <title>Data PEH</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header img {
            width: 100px; /* Sesuaikan ukuran logo sesuai kebutuhan */
            display: block;
            margin: 0 auto;
        }
        .header h1 {
            margin: 0;
            padding: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <!-- <img src="{{ public_path('img/logo.png') }}" alt="Logo"> Sesuaikan path logo sesuai kebutuhan -->
        <h1>Talkshow Interaktif PEH "PEH EDUKASI HOESIN'ERS"</h1>
        <h2>Rumah Sakit Mohammad Hoesin Palembang 2024</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Bulan</th>
                <th>Tema</th>
                <th>Waktu Kegiatan</th>
                <th>Narasumber</th>
                <th>Nama Narasumber</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peh as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl)->translatedFormat('F') }}</td>
                    <td>{{ $item->tema }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl)->translatedFormat('l, d F Y, 14:00 - 14:30') }}</td>
                    <td>Dokter Spesialis {{ $item->dokter->spesialisasi }}</td>
                    <td>{{ $item->dokter->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
