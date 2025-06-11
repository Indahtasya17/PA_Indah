@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Barang Lokal Keluar</h4>
                        <a href="{{ route('keluar-lokal.create') }}" class="btn btn-lg btn-primary">Tambah Barang</a>
                    </div>
                </div>
                <div class="card-body">
                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th class="text-center"> No</th>
                                <th>Nama barang</th>
                                <th>Tanggal</th>
                                <th>Jumlah Barang</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($transaksis as $key => $item)
                                <tr>
                                    <td class="text-center"> {{ $key + 1 }} </td>
                                    <td>
                                        <ol>
                                            @foreach ($item->items as $barangItemas)
                                                <li>{{ $barangItemas->barang->nama_barang }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>
                                        {{ $item->items->sum('stock') }} KG
                                        /
                                        {{ $item->items->sum('stock') / 1000 }} TON
                                    </td>
                                    <td>
                                        <ol>
                                            @foreach ($item->items as $barangItemas)
                                                <li>{{ $barangItemas->harga }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>
                                        {{ $item->items->sum('subtotal') }}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a class ="btn btn-sm btn-primary"
                                                href="{{ route('barang-import.keluar.detail', $item->id) }}">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a class ="btn btn-sm btn-success"
                                                href="{{ route('barang-import.keluar.edit', $item->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class ="btn btn-sm btn-danger" href="">
                                                <i class="fas fa-trash"></i>
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