@extends('layouting.guest.master')

@section('content')
    <div class = "row">
        <div class ="col-md-12 col-md-6">
            <div class ="card">
                <div class = "card-header">
                    <div class ="card-title"> Edit Data Barang </div>
                </div>
                <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang"
                                        name="nama_barang" value="{{ $barang->nama_barang }}" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="id_supplier">Nama Supplier</label>
                                    <select class="form-select form-control" name="id_supplier" id="id_supplier">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ $supplier->id == $barang->id_supplier ? 'selected' : '' }}>
                                                {{ $supplier->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <input type="number" class="form-control" id="harga_beli" name="harga_beli" placeholder="Harga Beli"
                                        value="{{ $barang->harga_beli }}" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual" placeholder="Harga Jual"
                                        value="{{ $barang->harga_jual }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="stok_barang">Stok Barang</label>
                                    <input type="number" class="form-control" id="stok_barang" name="stok" placeholder="Stok Barang"
                                        value="{{ $barang->stok }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="minimum_stok">Minumum Stok </label>
                                    <input type="number" class="form-control" id="minimum_stok" name="minimum_stok" placeholder="minumum stok"
                                        value="{{ $barang->minimum_stok }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan"
                                        value="{{ $barang->satuan }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger">Batal</button>
                    </div>
            </div>
        </div>
    @endsection
