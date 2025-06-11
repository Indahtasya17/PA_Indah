@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-pelabuhans-center">
                        <h4 class="card-title">Detail Barang Masuk Pelabuhan</h4>
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
                        <div class="alert alert-danger">{{ session('error') }}</div>
                </div>
                @endif

                <x-table>
                    @slot('tableHead')
                        <tr>
                            <th calss="text-center">No</th>
                            <th>Nama Barang</th>
                            <th>Tanggal</th>
                            <th>Jumlah Barang</th>
                            <th>No Invoice</th>
                            <th>No Container</th>
                            <th>Nomor Polisi</th>
                            <th>Harga Beli</th>
                            <th>Kontak</th>
                            <th>File</th>
                            <th class = "text-center">Aksi</th>
                        </tr>
                    @endslot

                    @slot('tableBody')
                        <tr>
                            <th class="text-center">1</th>
                            <th>{{ $pelabuhan->barang->nama_barang }}</th>
                            <th>{{ $pelabuhan->tanggal }}</th>
                            <th>{{ $pelabuhan->jumlah_barang }}</th>
                            <th>{{ $pelabuhan->no_invoice }}</th>
                            <th>{{ $pelabuhan->no_container }}</th>
                            <th>{{ $pelabuhan->no_polisi }}</th>
                            <th>{{ $pelabuhan->harga_beli }}</th>
                            <th>{{ $pelabuhan->kontak }}</th>
                            <th>{{ $pelabuhan->file }}</th>
                            <th>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a class="btn btn-sm btn-success" href="{{ route('pelabuhan.edit', $pelabuhan->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('pelabuhan.destroy', $pelabuhan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </th>
                        </tr>
                    @endslot
                </x-table>
            </div>
        </div>
    </div>
    </div>
@endsection
