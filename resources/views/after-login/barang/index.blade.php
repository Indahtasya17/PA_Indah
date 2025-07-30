@extends('layouting.guest.master')

@section('title', 'Barang')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Barang</h4>
                        @hasanyrole('karyawan-gudang')
                            <a href="{{ route('barang.create') }}" class="btn btn-primary">+ Tambah Barang</a>
                        @endhasanyrole
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
                                <th>Harga Modal</th>
                                <th>Harga Jual</th>
                                <th>Lama Pengiriman</th>
                                <th>Stok Barang</th>
                                <th>Safety stok</th>
                                <th>ROP</th>
                                @hasanyrole('karyawan-gudang')
                                    <th class="text-center">Aksi</th>
                                @endhasanyrole
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($barangs as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $item->nama_barang }}
                                        (Kode: {{ $item->kode_barang }})
                                    </td>
                                    <td>{{ $item->supplier->nama }}</td>
                                    <td> Rp{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                    <td> Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                    <td>{{ $item->waktu_tunggu }}</td>
                                    <td>
                                        {{ number_format($item->stok, 0, ',', '.') }} KG
                                        /
                                        {{ number_format($item->stok / 1000, 3, ',', '.') }} TON</>
                                    </td>
                                    </td>
                                    <td>{{ $item->safety_stock }}</td>
                                    <td>
                                        <span class="badge badge-{{ $item->badge_color }}">{{ $item->rop }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            @hasanyrole('karyawan-gudang')
                                                <a class = "btn btn-sm btn-success" href="{{ route('barang.edit', $item->id) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                @endhasanyrole
                                                @hasanyrole('karyawan-gudang')
                                                    <form action="{{ route('barang.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endhasanyrole
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
