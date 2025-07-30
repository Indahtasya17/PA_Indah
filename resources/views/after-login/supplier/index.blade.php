@extends('layouting.guest.master')

@section('title', 'Supplier')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Supplier</h4>
                        @hasallroles('karyawan-gudang')
                            <a href="{{ route('supplier.create') }}" class="btn btn-primary">+ Tambah Supplier</a>
                        @endhasallroles
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
                                @hasanyrole('karyawan-gudang')
                                <th class = "text-center">Aksi</th>
                                @endhasanyrole
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($suppliers as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->kontak }}</th>
                                    <td>
                                        <ol>
                                            @foreach ($item->barangs as $barang)
                                                <li>{{ $barang->nama_barang }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    @hasanyrole('karyawan-gudang')
                                    <td>
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
                                    </td>
                                    @endhasanyrole
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection
