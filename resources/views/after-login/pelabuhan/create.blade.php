@extends('layouting.guest.master')

@section('content')
    <form method="POST" action="{{ route('pelabuhan.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Barang</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row">
                            <!-- Nama Barang -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <select name="id_barang" id="id_barang" class="form-control" required>
                                        @foreach ($barangs as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Tanggal -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_masuk">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal" required />
                                </div>
                            </div>

                            <!-- Jumlah Barang -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Jumlah_Barang">Jumlah Barang</label>
                                    <input type="text" class="form-control" id="Jumlah_Barang" name="jumlah_barang"
                                        placeholder="Jumlah Barang" required />
                                </div>
                            </div>

                            <!-- Satuan -->
                            <div class="col-12 col-md-6" >
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select class="form-select" name="satuan" id="satuan" placeholder="Pilih Satuan">
                                        <option value="kg">Kg</option>
                                        <option value="ton">Ton</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Nomor Invoice -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="no_invoice">No Invoice</label>
                                    <input type="text" class="form-control" id="no_invoice" name="no_invoice"
                                        placeholder="Nomor Invoice" required />
                                </div>
                            </div>

                            <!-- Nomor Container -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="no_container">Nomor Container</label>
                                    <input type="text" class="form-control" id="no_container" name="no_container"
                                        placeholder="Nomor Container" required />
                                </div>
                            </div>

                            <!-- Nomor Polisi -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nomor_polisi">Nomor Polisi</label>
                                    <input type="text" class="form-control" id="nomor_polisi" name="no_polisi"
                                        placeholder="Nomor Polisi" required />
                                </div>
                            </div>

                            <!-- Harga Beli -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli </label>
                                    <input type="text" class="form-control" id="harga_beli" name="harga_beli"
                                        placeholder="Harga Beli" required />
                                </div>
                            </div>
                            <!-- Kontak -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="kontak"> Kontak </label>
                                    <input type="number" class="form-control" id="kontak" name="kontak"
                                        placeholder="Kontak" required />
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
                    <div class="card-header">
                        <h4 class="card-title">Tambah Dokumen</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- File Upload -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_upload">Sales Contact</label>
                                    <input type="file" class="form-control" id="file_upload" name="file[]">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_upload">Invoice</label>
                                    <input type="file" class="form-control" id="file_upload" name="file[] ">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_upload">Packing List</label>
                                    <input type="file" class="form-control" id="file_upload" name="file[]">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_upload">Bill Of Lading</label>
                                    <input type="file" class="form-control" id="file_upload" name="file[]">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_upload">Phytosamthing</label>
                                    <input type="file" class="form-control" id="file_upload" name="file[]">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_upload">Health Certificate</label>
                                    <input type="file" class="form-control" id="file_upload" name="file[]">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_upload">Fumigation</label>
                                    <input type="file" class="form-control" id="file_upload" name="file[]">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_upload">Certificate of Origin</label>
                                    <input type="file" class="form-control" id="file_upload" name="file[]">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_upload">Prior Nootice</label>
                                    <input type="file" class="form-control" id="file_upload" name="file[]">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="file_upload">Insurance</label>
                                    <input type="file" class="form-control" id="file_upload" name="file[]">
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="card-action mt-3">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
