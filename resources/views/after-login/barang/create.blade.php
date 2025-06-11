@extends('layouting.guest.master')

@section('content')
    <div class = "row">
        <div class ="col-md-12 col-md-6">
            <div class ="card">
                <div class = "card-header">
                    <div class ="card-title"> Tambah Data Barang </div>
                </div>
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
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
                                        name="nama_barang" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="id_supplier">Nama Supplier</label>
                                    <select name="id_supplier" id="id_supplier" class="form-select">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <input type="number" class="form-control" id="harga_beli" placeholder="Harga Beli"
                                        name="harga_beli" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="number" class="form-control" id="harga_jual" placeholder="Harga Jual"
                                        name="harga_jual">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="stok">Stok Barang</label>
                                    <input type="number" class="form-control" id="stok" placeholder="Stok Barang"
                                        name="stok">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" placeholder="Satuan"
                                        name="satuan">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="minimum_stok">Min Stock</label>
                                    <input type="number" class="form-control" id="minimum_stok" placeholder="minimum stok "
                                        name="minimum_stok">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
