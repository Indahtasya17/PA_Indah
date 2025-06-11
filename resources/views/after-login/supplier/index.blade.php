@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Supplier</h4>
                        <a href="{{ route('supplier.create') }}" class="btn btn-lg btn-primary">Tambah Supplier</a>
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
                                <th class = "text-center">No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kontak</th>
                                <th>produk</th>
                                <th class = "text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($suppliers as $key => $item)
                                <tr>
                                    <th class="text-center">{{ $key + 1 }}</th>
                                    <th>{{ $item->nama }}</th>
                                    <th>{{ $item->alamat }}</th>
                                    <th>{{ $item->kontak }}</th>
                                    <th>
                                        <ol>
                                            @foreach ($item->barangs as $barang)
                                                <li>{{ $barang->nama_barang }}</li>
                                            @endforeach
                                        </ol>
                                    </th>
                                    <th>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a class = "btn btn-sm btn-success" href="{{ route('supplier.edit', $item->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('supplier.destroy', $item->id) }}" method="POST">
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
