@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Data Barang Pelabuhan</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="POST" action="{{ route('pelabuhan.update', $pelabuhan->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        < class="row">
                            <!-- Nama Barang -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <select name="id_barang" id="id_barang" class="form-select" required>
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
                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal" required
                                        value="{{ $pelabuhan->tanggal }}" />
                                </div>
                            </div>

                            <!-- Jumlah Barang -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Jumlah_Barang">Jumlah Barang</label>
                                    <input type="text" class="form-control" id="Jumlah_Barang" name="jumlah_barang"
                                        placeholder="Jumlah Barang" required value="{{ $pelabuhan->jumlah_barang }}" />
                                </div>
                            </div>

                            <!-- Satuan -->
                            <div class="col-12 col-md-6">
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
                                    <label for="kontak">Kontak</label>
                                    <input type="text" class="form-control" id="kontak" name="kontak"
                                        placeholder="Kontak" value="{{ $pelabuhan->kontak }}" required />
                                </div>
                            </div>

                            <!-- Nomor Container -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="no_container">Nomor Container</label>
                                    <input type="text" class="form-control" id="no_container" name="no_container"
                                        placeholder="Nomor Container" value="{{ $pelabuhan->no_container }}" required />
                                </div>
                            </div>

                            <!-- Nomor Polisi -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nomor_polisi">Nomor Polisi</label>
                                    <input type="text" class="form-control" id="nomor_polisi" name="no_polisi"
                                        placeholder="Nomor Polisi" value="{{ $pelabuhan->no_polisi }}" required />
                                </div>
                            </div>

                            <!-- Harga Beli-->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <input type="text" class="form-control" id="harga_beli" name="harga_beli"
                                        placeholder="Harga Beli" value="{{ $pelabuhan->harga_beli }}" required />
                                </div>
                            </div>

                            <!-- kontak -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="kontak">Kontak</label>
                                    <input type="text" class="form-control" id="kontak" name="kontak"
                                        placeholder="Kontak" value="{{ $pelabuhan->kontak }}" required />
                                </div>
                            </div>

                            <!-- File Upload -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="file_upload">Upload Dokumen</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_upload" name="file">
                                        <label class="custom-file-label" for="file_upload">Pilih file</label>
                                    </div>
                                </div>
                            </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="card-action mt-3">
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
