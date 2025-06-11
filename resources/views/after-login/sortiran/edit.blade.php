@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Sortiran</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="kode_barang">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jumlah_sortiran">Jumlah Sortiran</label> <input type="text" class="form-control" id="jumlah_sortirsn" placeholder="Jumlah Sortiran" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jumlah_bagus">Jumlah Bagus</label>
                                <input type="text" class="form-control" id="jumlah_bagus" placeholder="Jumlah Bagus" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jumlah_rusak">Jumlah Rusak</label>
                                <input type="text" class="form-control" id="jumlah_rusak" placeholder="Jumlah Rusak" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success">Simpan</button>
                    <button class="btn btn-danger">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection

