@extends('layouting.guest.master')

@section('title', 'Edit Barang')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Data Barang</div>
                </div>
                <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- penting untuk method PUT --}}
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
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                        value="{{ old('nama_barang', $barang->nama_barang) }}" placeholder="Nama Barang" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                        value="{{ old('kode_barang', $barang->kode_barang) }}" placeholder="Kode Barang" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="id_supplier">Nama Supplier</label>
                                    <select name="id_supplier" id="id_supplier" class="form-control">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ old('id_supplier', $barang->id_supplier) == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                        value="{{ old('harga_beli', $barang->harga_beli) }}" placeholder="Harga Beli" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                        value="{{ old('harga_jual', $barang->harga_jual) }}" placeholder="Harga Jual" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="stok">Stok Barang</label>
                                    <input type="number" class="form-control" id="stok" name="stok"
                                        value="{{ old('stok', $barang->stok) }}" placeholder="Stok Barang" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="waktu_tunggu">Lama Pengiriman</label>
                                    <input type="number" class="form-control" id="waktu_tunggu" name="waktu_tunggu"
                                        value="{{ old('waktu_tunggu', $barang->waktu_tunggu) }}"
                                        placeholder="Waktu Tunggu" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('barang') }}" class="btn btn-danger">Batal</a>
                    </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
@endsection
