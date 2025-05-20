@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Transaksi Data Barang Keluar</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="nopol">Nomor Polisi</label>
                                <input type="text" class="form-control" id="nopol" placeholder="Nomor Polisi" />
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
                                <label for="kode_cv">Kode CV</label>
                                <input type="text" class="form-control" id="kode_cv" placeholder="Kode CV" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Detail Barang</h4>
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-lg btn-primary">Tambah
                            Barang</button>
                    </div>
                </div>
                <div class="card-body">
                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th class ="text-center">No</th>
                                <th>Nama barang</th>
                                <th>Jumlah Barang</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th class ="text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            <tr>
                                <th class ="text-center">1</th>
                                <th>Ayam</th>
                                <th style="width: 20px!important;">
                                    <input type="text" value="2" name="jumlah[]">
                                </th>
                                <th style="width: 20px!important;">
                                    <input type="text" value="ayam" name="satuan[]">
                                    </th>
                                <th style="width: 20px!important;">
                                    <input type="text" value="2000" name="harga[]">
                                </th>
                                <th style="width: 20px;">
                                    <input type="text" value="4000" name="subtotal[]">
                                </th>
                                <th>
                                    <a class ="btn btn-sm btn-danger" href="">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </th>
                            </tr>
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Detail File</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Dokumen</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Dokumen</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Dokumen</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Dokumen</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Dokumen</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Dokumen</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-action d-flex gap-2">
                    <button class="btn btn-success w-50">Simpan</button>
                    <button class="btn btn-danger w-50">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nama Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="barang"> Nama Barang</label>
                                <select class="form-select" name="barang" id="barang">
                                    <option value="ayam">Bawang Merah</option>
                                    <option value="bawang">Bawang Putih</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jumlah">Jumlah Barang</label>
                                <input type="text" class="form-control" id="jumlah" placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control" id="satuan" placeholder="Satuan" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" class="form-control" id="harga" placeholder="Harga Barang" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
