@extends('layouting.guest.master')

@section('title', 'Laporan Barang')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="card-title">Laporan</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('laporan') }}" method="GET">
                        <div class="row">
                            {{-- Pilih Kategori --}}
                            <div class="col-12 col-md-3">
                                <label for="kategori">Pilih Kategori</label>
                                <select class="form-control" id="kategori" name="kategori">
                                    <option value="">--Pilih Kategori--</option>
                                    <option value="masuk" {{ request('kategori') == 'masuk' ? 'selected' : '' }}>Barang
                                        Masuk</option>
                                    <option {{ request('kategori') == 'keluar' ? 'selected' : '' }} value="keluar">Barang
                                        Keluar</option>
                                </select>
                            </div>

                            {{-- Pilih Barang --}}
                            <div class="col-12 col-md-3">
                                <label for="id_barang">Pilih Barang</label>
                                <select class="form-control" id="id_barang" name="id_barang">
                                    <option value="">--Pilih Barang--</option>
                                    @foreach ($barangs as $barang)
                                        <option {{ request('id_barang') == $barang->id ? 'selected' : '' }}
                                            value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tanggal Awal --}}
                            <div class="col-12 col-md-3">
                                <label for="tanggal_awal">Pilih Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal"
                                    value="{{ request('tanggal_awal') }}">
                            </div>

                            {{-- Tanggal Akhir --}}
                            <div class="col-12 col-md-3">
                                <label for="tanggal_akhir">Pilih Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir"
                                    value="{{ request('tanggal_akhir') }}">
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <a href="{{ route('laporan') }}" class="btn btn-danger">Reset</a>
                            <button type="submit" class="btn btn-success">Proses</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Data Laporan</h5>

                    @if ($transaksis->count() > 0)
                        <a href="{{ route('laporan.print') }}?kategori={{ request('kategori') }}&id_barang={{ request('id_barang') }}&tanggal_awal={{ request('tanggal_awal') }}&tanggal_akhir={{ request('tanggal_akhir') }}"
                            class="btn btn-primary">Print</a>
                    @endif
                </div>
                <div class="card-body">

                    <div class="row">

                        {{-- Tabel Laporan --}}
                        <x-table>
                            @slot('tableHead')
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Tanggal</th>
                                <th>Jumlah Barang</th>
                                <th>Kategori</th>
                                <th>Total</th>
                            @endslot

                            @slot('tableBody')
                                @forelse ($transaksis as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <ol>
                                                @foreach ($item->items as $barangItem)
                                                    <li>{{ $barangItem->barang->nama_barang ?? '-' }}</li>
                                                @endforeach
                                            </ol>
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                        <td>
                                            {{ number_format($item->items->sum('stock'), 0, ',', '.') }} KG
                                            /
                                            {{ $item->items->sum('stock') / 1000 }} TON
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $item->tipe_transaksi == 'masuk' ? 'bg-success' : 'bg-primary' }}">
                                                {{ $item->tipe_transaksi }}
                                            </span>
                                        </td>
                                        <td>Rp {{ number_format($item->total_tagihan, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
                                    </tr>
                                @endforelse
                            @endslot
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
