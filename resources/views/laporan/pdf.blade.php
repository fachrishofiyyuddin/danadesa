<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Realisasi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #eee;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body>

    <h3 class="center">LAPORAN REALISASI KEGIATAN</h3>

    <p>
        <strong>Kegiatan:</strong> {{ $rab->nama_kegiatan }}<br>
        <strong>Penanggung Jawab:</strong> {{ $rab->user->name ?? '-' }}<br>
        <strong>Anggaran:</strong> Rp {{ number_format($rab->jumlah_anggaran, 0, ',', '.') }}<br>
        <strong>Total Realisasi:</strong>
        Rp {{ number_format($totalRealisasi, 0, ',', '.') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No SPP</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Metode</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($rab->spps as $spp)
                @foreach ($spp->pembayarans as $bayar)
                    <tr>
                        <td class="center">{{ $no++ }}</td>
                        <td>{{ $spp->nomor_spp }}</td>
                        <td class="center">{{ $bayar->tanggal }}</td>
                        <td class="right">
                            Rp {{ number_format($bayar->jumlah_dibayar, 0, ',', '.') }}
                        </td>
                        <td class="center">{{ $bayar->metode }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <br><br>

    <table width="100%" style="border:none;">
        <tr>
            <td width="60%"></td>
            <td class="center">
                Kepala Desa<br><br><br>
                <strong>( __________________ )</strong>
            </td>
        </tr>
    </table>

</body>

</html>
