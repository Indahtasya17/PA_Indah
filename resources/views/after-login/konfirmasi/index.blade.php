@extends('layouting.guest.master')

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
                                <th>Nama barang</th>
                                <th>Tanggal</th>
                                <th>Nomor Invoice</th>
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
                                        <ol>
                                            @foreach ($item->items as $barangItem)
                                                <li>{{ $barangItem->barang->nama_barang ?? '-' }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>
                                        {{ $item->barang_import_masuk->no_invoice ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $item->items->sum('stock') }} KG
                                        /
                                        {{ $item->items->sum('stock') / 1000 }} TON
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $item->status == 'diterima' ? 'bg-success' : ($item->status == 'dikirim' ? 'bg-primary' : 'bg-danger') }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a
                                                class ="btn btn-sm btn-primary"href="{{ route('konfirmasi.detail', $item->id) }}">
                                                <i class="fas fa-correct"></i>
                                            </a>
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
