@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Barang Import Masuk</h4>
                        <a href="{{ route('barang-import.masuk.create') }}" class="btn btn-lg btn-primary">Tambah Barang</a>
                    </div>
                </div>
                <div class="card-body">
                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th class ="text-center">No</th>
                                <th>Nama barang</th>
                                <th>Tanggal</th>
                                <th>Nomor Invoice</th>
                                <th>Nomor Kontener</th>
                                <th>Jumlah Barang</th>
                                <th>Satuan</th>
                                <th class ="text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                        <tr>
                            <th class ="text-center">1</th>
                            <th>Nama barang</th>
                            <th>Tanggal</th>
                            <th>Nomor Invoice</th>
                            <th>Nomor Kontener</th>
                            <th>Jumlah Barang</th>
                            <th>Satuan</th>
                            <th>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a class ="btn btn-sm btn-primary"href="{{ route('barang-import.masuk.detail',1) }}">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a class ="btn btn-sm btn-success" href="{{ route('barang-import.masuk.edit', 1) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a class ="btn btn-sm btn-danger" href="">
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
