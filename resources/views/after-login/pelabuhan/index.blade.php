@extends('layouting.guest.master')

@section('title', 'Pelabuhan')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Barang Masuk Pelabuhan</h4>
                        <a href="{{ route('pelabuhan.create') }}" class="btn btn- btn-primary">Tambah Barang</a>
                    </div>
                </div>
                <div class="card-body">

                    @if (@session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div></div>
                    @endif
                    
                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th calss="text-center">No</th>
                                <th>Nama Barang</th>
                                <th>Tanggal</th>
                                <th>Jumlah Barang</th>
                                <th>No Invoice</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                        @foreach ( $pelabuhan as $key=> $item)
                                <tr>
                                    <th class="text-center">{{ $key + 1 }}</th>
                                    <th>{{ $item->barang->nama_barang }}</th>
                                    <th>{{ $item->tanggal }}</th>   
                                    <th>{{ $item->jumlah_barang }}</th>
                                    <th>{{ $item->no_invoice }}</th>
                                    <th>
                                        <span
                                            class="badge {{ $item->status == 'diterima' ? 'bg-success' : ($item->status == 'dikirim' ? 'bg-primary' : 'bg-danger') }}">
                                            {{ $item->status }}
                                        </span>
                                    </th>
                                    <th>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a class="btn btn-sm btn-primary" href="{{ route('pelabuhan.detail', $item->id) }}">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a class="btn btn-sm btn-success" href="{{ route('pelabuhan.edit', $item->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('pelabuhan.destroy', $item->id) }}" method="POST">
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
