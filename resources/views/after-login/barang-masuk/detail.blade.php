@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Transaksi Data Barang Masuk</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nomor Polisi</label>
                                <p class="form-control-plaintext">B 1234 ABC</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <p class="form-control-plaintext">2025-05-10</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nomor Invoice</label>
                                <p class="form-control-plaintext">INV-2025-001</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Nomor Kontener</label>
                                <p class="form-control-plaintext">CNT-00123</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail File (dipindahkan ke bawah) --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail File</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="#">Surat Jalan 1 (PDF)</a></li>
                        <li><a href="#">Surat Jalan 2 (JPG)</a></li>
                        <li><a href="#">Surat Jalan 3 (PNG)</a></li>
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
                                <td>Ayam</td>
                                <td>2</td>
                                <td>Kg</td>
                                <td>Rp 2.000</td>
                                <td>Rp 4.000</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Bawang</td>
                                <td>5</td>
                                <td>Kg</td>
                                <td>Rp 1.500</td>
                                <td>Rp 7.500</td>
                            </tr>
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>

    
@endsection
