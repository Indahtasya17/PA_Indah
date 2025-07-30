@extends('layouting.guest.master')

@section('title', 'Barang Masuk')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Barang Masuk</h4>
                            <div>
                                <label for="filter">Jenis Barang</label>
                                <form action="{{ route('barang-masuk.index') }}" method="GET">
                                    <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
                                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>ALL
                                        </option>
                                        <option value="import" {{ request('filter') == 'import' ? 'selected' : '' }}>Barang
                                            Import</option>
                                        <option value="lokal" {{ request('filter') == 'lokal' ? 'selected' : '' }}>Barang
                                            Lokal</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        @hasanyrole('karyawan-gudang')
                            <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary"> + Tambah Barang Masuk
                                Lokal</a>
                        @endhasanyrole
                    </div>
                </div>
                <div class="card-body">

                    @if (@session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                </div>
                @endif
                <x-table>
                    @slot('tableHead')
                        <tr>
                            <th class ="text-center">No</th>
                            <th>Nomor Invoice</th>
                            <th>Tanggal</th>
                            <th>Nama barang</th>
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
                                    {{ $item->barang_import_masuk->no_invoice ?? '-' }}
                                </td>
                                <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                <td>
                                    <ol>
                                        @foreach ($item->items as $barangItem)
                                            <li>{{ $barangItem->barang->nama_barang ?? '-' }} (Kode:
                                                {{ $barangItem->barang->kode_barang }})</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>
                                    <span class="badge {{ $item->sumber_transaksi == 'lokal' ? 'bg-success' : 'bg-primary' }}">
                                        {{ $item->sumber_transaksi }}
                                    </span>
                                </td>
                                <td>
                                    {{ number_format($item->items->sum('stock'), 0, ',', '.') }} KG
                                    /
                                    {{ $item->items->sum('stock') / 1000 }} TON
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a class ="btn btn-sm btn-primary"href="{{ route('barang-masuk.detail', $item->id) }}">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        @if ($item->sumber_transaksi == 'lokal')
                                            <a class ="btn btn-sm btn-success"
                                                href="{{ route('barang-masuk.edit', $item->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif
                                        @hasanyrole('karyawan-gudang')
                                        <form action="{{ route('barang-masuk.destroy', $item->id) }}" method="POST">
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
