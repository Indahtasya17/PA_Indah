@extends('layouting.guest.master')

@section('title', 'Detail Barang Keluar')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Transaksi Data Barang Keluar</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nama Customer</label>
                                <p class="form-control-plaintext">
                                    {{ $transaksi->barang_keluar_customer->nama_customer ?? $transaksi->barang_keluar_customer->nama }}
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <p class="form-control-plaintext">
                                    {{ date('d-m-Y', strtotime($transaksi->tanggal)) }}
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nomor Polisi</label>
                                <p class="form-control-plaintext">{{ $transaksi->no_polisi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Barang --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Barang</h4>
                </div>
                <div class="card-body">
                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Harga Jual</th>
                                <th>Subtotal</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($transaksi->items as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        {{ $item->barang->nama_barang }}
                                    </td>
                                    <td>
                                        {{ $item->stock }} Kg
                                        /
                                        {{ $item->stock / 1000 }} Ton
                                    </td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item->stock * $item->harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection
