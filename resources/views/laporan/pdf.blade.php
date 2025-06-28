<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengiriman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .statistic {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Pengiriman</h2>
        <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
    </div>

    <div class="statistic">
        <p><strong>Tepat Waktu:</strong> {{ $tepatWaktu }} Pengiriman</p>
        <p><strong>Terlambat:</strong> {{ $terlambat }} Pengiriman</p>
        <p><strong>Rata-rata Waktu Pengiriman:</strong> {{ $rataWaktuPengiriman }} Menit</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kendaraan</th>
                <th>Driver</th>
                <th>Rute</th>
                <th>Status</th>
                <th>Estimasi Kedatangan</th>
                <th>Waktu Kedatangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengiriman as $item)
                <tr>
                    <td>{{ $item->kendaraan->nomor_polisi }}</td>
                    <td>{{ $item->driver->name }}</td>
                    <td>{{ $item->rute->asal }} - {{ $item->rute->tujuan }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->estimasi_kedatangan }}</td>
                    <td>{{ $item->kedatangan_sebenarnya }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
