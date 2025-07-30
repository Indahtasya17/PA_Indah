@extends('layouting.guest.master')

@section('title', 'Konfirmasi')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Konfirmasi Barang Masuk</h4>
                </div>
                <div class="card-body">
                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th class ="text-center">No</th>
                                <th>Nomor Invoice</th>
                                <th>Tanggal</th>
                                <th>Nama barang</th>
                                <th>Jumlah Barang</th>
                                <th>Status</th>
                                <th class ="text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($transaksis as $key => $item)
                                <tr>
                                    <td class ="text-center">{{ $key + 1 }}</td>
                                    <td>
                                        {{ $item->barang_import_masuk->no_invoice ?? '-' }}
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                    <td>
                                        <ol>
                                            @foreach ($item->items as $barangItem)
                                                <li>{{ $barangItem->barang->nama_barang ?? '-' }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>
                                        {{ number_format($item->items->sum('stock'), 0, ',', '.') }} KG
                                        /
                                        {{ $item->items->sum('stock') / 1000 }} TON
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ strtolower($item->status) == 'diterima' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a class="btn btn-sm btn-primary" href="{{ route('pelabuhan.detail', $item->id) }}">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            @if (strtolower($item->status) === 'dikirim')
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('konfirmasi.detail', $item->id) }}">
                                                    <i class="icon-note"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection
