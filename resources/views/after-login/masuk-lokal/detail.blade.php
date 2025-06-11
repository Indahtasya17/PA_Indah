@extends('layouting.guest.master')

@section('content')
    {{-- Informasi Transaksi --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Transaksi Barang Masuk Lokal</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Kode Barang</label>
                                <p class="form-control-plaintext">BRG-002</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <p class="form-control-plaintext">2025-05-15</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nomor Polisi</label>
                                <p class="form-control-plaintext">B 5678 XYZ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail File --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail File</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="#">Dokumen Surat Jalan.pdf</a></li>
                        <li><a href="#">Invoice Barang Keluar.jpg</a></li>
                        <li><a href="#">Dokumen Tambahan.png</a></li>
                    </ul>
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
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            <tr>
                                <td class="text-center">1</td>
                                <td>Merah Bima</td>
                                <td>2</td>
                                <td>Kg</td>
                                <td>Rp 2.000</td>
                                <td>Rp 4.000</td>
                            </tr>
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection
