@extends('layouting.guest.master')

@section('content')
<div class = "row">
    <div class ="col-md-12 col-md-6">
        <div class ="card">
            <div class = "card-header">
                <div class ="card-title"> Laporan Barang </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang" />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="tanggal_masuk">No Invoice</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="importmasuk">Nama Kontener</label>
                        <input type="importmasuk" class="form-control" id="importmasuk" placeholder="Nama Barang" />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="from-group">
                        <label for="barang">Jumlah Barang</label>
                        <input type="barang" class="form-control"
                        id="barang" placeholder="Harga Beli" />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="from-group">
                        <label for="barang">No Polisi</label>
                        <input type="barang" class="form-control" id="barang" placeholder="Harga Jual">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="from-group">
                        <label for="barnag">Harga</label>
                        <input type="barang" class="form-control" id="barang" placeholder="Stok Barang">
                    </div>
                </div>
    </div>
    </div>
</div>
</div>
@endsection
