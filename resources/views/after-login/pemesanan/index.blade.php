@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Data Barang Masuk</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="nopol">Nomor Polisi</label>
                                <input type="text" class="form-control" id="nopol" placeholder="Nama Barang"  />
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
                                <label for="nomor_invoice">Nomor Invoice</label>
                                <input type="text" class="form-control" id="nomor_invoice" placeholder="Nomor Invoice" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="nomor_kontener">Nomor Kontener</label>
                                <input type="text" class="form-control" id="nomor_kontener"
                                    placeholder="Nomor Kontener" />
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
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th class ="text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            <tr>
                                <th class ="text-center">1</th>
                                <th>Ayam</th>
                                <th>2</th>
                                <th>1000</th>
                                <th>2000</th>
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
                                <label for="surat_jalan">Surat Jalan</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Surat Jalan</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Surat Jalan</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Surat Jalan</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Surat Jalan</label>
                                <input type="file" class="form-control" id="surat_jalan" name="surat_jalan"
                                    placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="surat_jalan">Surat Jalan</label>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="barang">Barang</label>
                                <select class="form-select" name="barang" id="barang">
                                    <option value="ayam">ayam</option>
                                    <option value="bawang">bawang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control" id="jumlah" placeholder="Nama Barang" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" class="form-control" id="harga" placeholder="Nama Barang" />
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
