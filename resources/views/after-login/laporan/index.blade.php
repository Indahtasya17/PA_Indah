@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <div class="card-title">Pilih Bagian Barang dan Range Waktu</div>
                </div>
                
                <div class="card-body">
                <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="defaultSelect">Pilih Barang</label>
                    <select class="form-select form-control" id="defaultSelect" placeholder="Pilih Barang">
                        <option>Bawang Putih</option>
                        <option>Bawang Merah</option>
                        <option>Bawang Bombai</option>
                        <option>Bawang Merah Bima</option>
                        <option>Bawang Merah Pakistan</option>
                        <option>Cabe Kering</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="defaultSelect">Pilih Kategori</label>
                    <select class="form-select form-control" id="defaultSelect" placeholder="Pilih Barang">
                        <option>Barang Masuk</option>
                        <option>Bawang Keluar</option>
                    </select>
                </div>
            </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="tanggal_masuk">Pilih Tanggal Awal</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="tanggal_masuk">Pilih Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" />
                    </div>
                </div>

                <div class="card-action">
                    <button class="btn btn-success">Peroses</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
