@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Barang Masuk</h4>

                            <div>
                                <label for="">Filter</label>
                                <select name="" id="" class="form-control">
                                    <option value="all">all</option>
                                    <option value="import">Barang Import</option>
                                    <option value="lokal">Barang Lokal</option>
                                </select>
                            </div>
                        </div>
                        <a href="{{ route('barang-masuk.masuk.create') }}" class="btn btn-lg btn-primary">Tambah Masuk
                            Lokal</a>
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
                                <th>Jenis</th>
                                <th>Jumlah Barang</th>
                                <th class ="text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($transaksis as $key => $item)
                                <tr>
                                    <td class ="text-center">{{ $key + 1 }}</td>
                                    <td>
                                        <ol>
                                            @foreach ($item->items as $barangItem)
                                                <li>{{ $barangItem->barang->nama_barang ?? '-' }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>
                                        {{ $item->barang_import_masuk->no_invoice ?? '-' }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $item->sumber_transaksi == 'lokal' ? 'bg-success' : 'bg-primary' }}">
                                            {{ $item->sumber_transaksi }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $item->items->sum('stock') }} KG
                                        /
                                        {{ $item->items->sum('stock') / 1000 }} TON
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a
                                                class ="btn btn-sm btn-primary"href="{{ route('barang-masuk.masuk.detail', $item->id) }}">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a class ="btn btn-sm btn-success"
                                                href="{{ route('barang-masuk.masuk.edit', $item->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class ="btn btn-sm btn-danger" href="">
                                                <i class="fas fa-trash"></i>
                                            </a>
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
