@extends('layouting.guest.master')

@section('title', 'Tambah Barang')
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
                                    <x-form-label for="nama_barang" :required="true">Nama Barang</x-form-label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                        placeholder="Nama Barang" required />
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" placeholder="Kode Barang"
                                        name="kode_barang" />
                                </div>
                            </div>
                            <div class="col-12  ">
                                <div class="form-group">
                                    <label for="id_supplier">Nama Supplier</label>
                                    <select name="id_supplier" id="id_supplier" class="form-control" required>
                                        <option value="" selected>-- Pilih Supplier -- </option>
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
                            {{-- <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="stok">Stok Barang</label>
                                    <input type="number" class="form-control" id="stok" placeholder="Stok Barang"
                                        name="stok">
                                </div>
                            </div> --}}
                            {{-- <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Lama_Pengiriman">Lama Pengiriman</label>
                                    <input type="number" class="form-control" id="waktu_tunggu"
                                        placeholder=" Waktu Tunggu " name="waktu_tunggu">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" a href="{{ url()->previous() }}" class="btn btn-danger">Batal</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>
@endsection
