@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Pemesanan</h4>
                        <a href="{{ route('pemesanan.create') }}" class="btn btn-lg btn-primary">Tambah Barang</a>
                    </div>
                </div>
                <div class="card-body">
                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            <tr>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>File</th>
                                <th>
                                    <div class="d-flex gap-3">
                                        <a href="{{ route('pemesanan.edit', 1) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Pemesanan</h4>
                        <a href="{{ route('pemesanan.create') }}" class="btn btn-lg btn-primary">Tambah Barang</a>
                    </div>
                </div>
                <div class="card-body">
                    <x-table id="table2">
                        @slot('tableHead')
                            <tr>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            <tr>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>File</th>
                                <th>
                                    <div class="d-flex gap-3">
                                        <a href="{{ route('pemesanan.edit', 1) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection
