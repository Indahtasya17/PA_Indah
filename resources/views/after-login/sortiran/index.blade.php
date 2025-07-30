@extends('layouting.guest.master')

@section('title', 'Sortiran')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Sortiran</h4>
                        @hasanyrole('karyawan-gudang')
                        <a href="{{ route('sortiran.create') }}" class="btn btn-primary">+ Tambah Sortiran</a>
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
                                <th class = "text-center">No</th>
                                <th>Nama Barang</th>
                                <th>Tanggal</th>
                                <th>Jumlah Sortiran</th>
                                <th>Jumlah Bagus</th>
                                <th>Jumlah Busuk</th>
                                <th>Satuan</th>
                                @hasanyrole('karyawan-gudang')
                                <th class = "text-center">Aksi</th>
                                @endhasanyrole
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($sortirs as $key => $item)
                                <tr>
                                    <td class ="text-center"> {{ $key + 1 }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                    <td>{{ $item->jumlah_sortiran }}</td>
                                    <td>{{ $item->jumlah_bagus }}</td>
                                    <td>{{ $item->jumlah_busuk }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    @hasanyrole('karyawan-gudang')
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a class = "btn btn-sm btn-success" href="{{ route('sortiran.edit', $item->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('sortiran.destroy', $item->id) }}" method="POST">
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
