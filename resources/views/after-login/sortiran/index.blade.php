@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Barang Sortiran</h4>
                        <a href="{{ route('sortiran.create') }}" class="btn btn-lg btn-primary">Tambah Sortiran</a>
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
                                <th class = "text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($sortirs as $key => $item)
                                <tr>
                                    <th class ="text-center"> {{ $key + 1 }}</th>
                                    <th>{{ $item->barang->nama_barang }}</th>
                                    <th>{{ $item->tanggal }}</th>
                                    <th>{{ $item->jumlah_sortiran }}</th>
                                    <th>{{ $item->jumlah_bagus }}</th>
                                    <th>{{ $item->jumlah_busuk }}</th>
                                    <th>{{ $item->satuan }}</th>
                                    <th>
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
