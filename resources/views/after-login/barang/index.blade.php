@extends('layouting.guest.master')

@section('title', 'Barang')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Barang</h4>
                        <a href="{{ route('barang.create') }}" class="btn btn-lg btn-primary">Tambah Barang</a>
                    </div>
                </div>
                <div class="card-body">
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Barang</th>
                                <th>Nama Suplier</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok Barang</th>
                                <th>Minumum Stock</th>
                                <th>Satuan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($barangs as $key => $item)
                                <tr>
                                    <th class="text-center">{{ $key + 1 }}</th>
                                    <th>{{ $item->nama_barang }}</th>
                                    <th>{{ $item->supplier->nama }}</th>
                                    <th>{{ toIDR($item->harga_beli )}}</th>
                                    <th>{{ toIDR($item->harga_jual) }}</th>
                                    <th>{{ $item->minimum_stok }}</th>
                                    <th>{{ $item->stok }}</th>
                                    <th>{{ $item->satuan }}</th>
                                    <th>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a class = "btn btn-sm btn-success" href="{{ route('barang.edit', $item->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection
