@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Data Barang Pelabuhan</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="POST" action="{{ route('pelabuhan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
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
                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal" required />
                                </div>
                            </div>

                            <!-- Jumlah Barang -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Jumlah_Barang">Jumlah Barang</label>
                                    <input type="text" class="form-control" id="Jumlah_Barang" name="jumlah_barang"
                                        placeholder="Jumlah Barang" required/>
                                </div>
                            </div>

                            <!-- Nomor Polisi -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nomor_polisi">Nomor Polisi</label>
                                    <input type="text" class="form-control" id="nomor_polisi" name="no_polisi"
                                        placeholder="Nomor Polisi" required/>
                                </div>
                            </div>

                            <!-- Nomor Container -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="no_container">Nomor Container</label>
                                    <input type="text" class="form-control" id="no_container" name="no_container"
                                        placeholder="Nomor Container" required/>
                                </div>
                            </div>

                            <!-- jumlah Container -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Jumlah_container">Jumlah Container</label>
                                    <input type="text" class="form-control" id="Jumlah_container" name="jumlah_container"
                                        placeholder="Jumlah Container" required/>
                                </div>
                            </div>

                            <!-- Nomor Invoice -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="kontak">Kontak</label>
                                    <input type="text" class="form-control" id="kontak" name="kontak"
                                        placeholder="Kontak" required/>
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
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
