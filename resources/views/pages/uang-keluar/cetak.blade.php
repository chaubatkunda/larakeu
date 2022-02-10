<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Pengeluaran - Lara'keu</title>
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table td,
        .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #152C5B;
            color: white;
            text-align: center;
        }

        .title h5 {
            font-size: 18px;
            text-align: center;
            border-bottom: 1px solid #152C5B;
        }

    </style>
</head>

<body>
    <div class="title">
        <h5>Laporan Pengeluaran</h5>
    </div>
    <table class="table">
        <tr>
            <th>#</th>
            <th>Keterangan</th>
            <th>Price</th>
        </tr>
        @forelse ($expenditures as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->keterangan }}</td>
                <td align="right">{{ rupiah($item->price) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    Data tidak ditemukan
                </td>
            </tr>
        @endforelse
        <tr>
            <td colspan="2">Total Pengeluaran</td>
            <td align="right">{{ rupiah($expenditures->sum('price')) }}</td>
        </tr>
    </table>
</body>

</html>
