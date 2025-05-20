@extends('layouting.guest.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Pemesanan</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <!-- Invoice -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="invoice">Invoice</label>
                                <input type="text" class="form-control" id="invoice" name="invoice" placeholder="Invoice" />
                            </div>
                        </div>

                        <!-- Nama Barang -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" />
                            </div>
                        </div>

                        <!-- Tanggal -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" />
                            </div>
                        </div>

                        <!-- Jumlah Barang -->
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jumlah_barang">Jumlah Barang</label>
                                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="Jumlah Barang" />
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="file_upload">Upload Dokumen</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_upload" name="file_upload">
                                    <label class="custom-file-label" for="file_upload">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <!-- Tombol Aksi -->
                    <div class="card-action mt-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection




