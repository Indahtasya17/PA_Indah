@extends('layouting.guest.master')

@section('title', 'Barang Keluar')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Barang Keluar</h4>
                        @hasanyrole('karyawan-gudang')
                        <a href="{{ route('barang-keluar.create') }}" class="btn btn-primary"> + Tambah Barang Keluar</a>
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
                                <th class="text-center"> No</th>
                                <th>Nama barang</th>
                                <th>Tanggal</th>
                                <th>Jumlah Barang</th>
                                <th>Harga Jual</th>
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
                                                <li>{{ $barangItemas->barang->nama_barang }} (Kode: {{ $barangItemas->barang->kode_barang }})
                                                </li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                    <td>
                                        <ol>
                                            @foreach ($item->items as $barangItemas)
                                                <li>
                                                    {{ $barangItemas->stock }} Kg
                                                    /
                                                    {{ $barangItemas->stock / 1000 }} Ton
                                                </li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>
                                        <ol>
                                            @foreach ($item->items as $barangItemas)
                                                <li>Rp {{ number_format($barangItemas->harga, 0, ',', '.') }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>
                                        Rp {{ number_format($item->items->sum('subtotal'), 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a class ="btn btn-sm btn-primary"
                                                href="{{ route('barang-keluar.detail', $item->id) }}">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            @hasanyrole('karyawan-gudang')
                                            <a class ="btn btn-sm btn-success"
                                                href="{{ route('barang-keluar.edit', $item->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('barang-keluar.destroy', $item->id) }}" method="POST">
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
