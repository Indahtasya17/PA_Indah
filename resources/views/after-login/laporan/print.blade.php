<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Barang</title>


    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }

        h2,
        h3 {
            text-align: center;
            margin-bottom: 1px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
        }

        .bg-success {
            background-color: green;
        }

        .bg-primary {
            background-color: blue;
        }

        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .no-data {
            text-align: center;
            font-style: italic;
        }

        .text-end {
            text-align: right;
        }

        ol {
            padding-left: 8px;
        }

        @media print {
            a {
                display: none;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <h2>Laporan
        @if (request('kategori'))
            {{ request('kategori') == 'masuk' ? 'Barang Masuk' : 'Barang Keluar' }}
        @endif
    </h2>
    <h3>CV. Limbong Holena</h3>


    <p>Tanggal Print: {{ formatTanggalIndo(now()) }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Jumlah Barang</th>
                <th>
                    @if (request('kategori') != null)
                        {{ request('kategori') == 'masuk' ? 'Harga Beli' : 'Harga Jual' }}
                    @else
                        Harga Jual/Beli
                    @endif
                </th>
                <th>Kategori</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksis as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <ol>
                            @foreach ($item->items as $barangItem)
                                <li>{{ $barangItem->barang->nama_barang ?? '-' }}</li>
                            @endforeach
                        </ol>
                    </td>
                    <td>{{ formatTanggalIndo($item->tanggal) }}</td>
                    <td>
                        {{ number_format($item->items->sum('stock'), 0, ',', '.') }} KG
                        /
                        {{ $item->items->sum('stock') / 1000 }} TON
                    </td>
                    <td>
                        <ol>
                            @foreach ($item->items as $barangItem)
                                @if ($item->tipe_transaksi == 'masuk')
                                    <li>Rp
                                        {{ number_format($barangItem->harga ?? 0, 0, ',', '.') }}
                                    </li>
                                @else
                                    <li>Rp
                                        {{ number_format($barangItem->barang->harga_jual ?? 0, 0, ',', '.') }}
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </td>
                    <td>
                        <span class="badge {{ $item->tipe_transaksi == 'masuk' ? 'bg-success' : 'bg-primary' }}">
                            {{ $item->tipe_transaksi }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($item->total_tagihan, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="no-data">Data tidak ditemukan</td>
                </tr>
            @endforelse

            <tr>
                <th colspan="6" class="text-end">Total</th>
                <th>Rp {{ number_format($transaksis->sum('total_tagihan'), 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>
</body>

</html>
