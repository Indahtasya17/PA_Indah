@extends('layouting.guest.master')

@section('title', 'Edit ')
@section('content')
    <form method="POST" action="{{ route('pelabuhan.update', $pelabuhan->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Barang</h4>
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
                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal" required
                                        value="{{ $pelabuhan->tanggal }}" />
                                </div>
                            </div>

                            <!-- Jumlah Barang -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Jumlah_Barang">Jumlah Barang</label>
                                    <input type="number" class="form-control" id="Jumlah_Barang" name="jumlah_barang"
                                        placeholder="Jumlah Barang" required value="{{ $pelabuhan->items[0]->stock }}" />
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
                                    <label for="no_invoice">No Invoice</label>
                                    <input type="text" class="form-control" id="no_invoice" name="no_invoice"
                                        placeholder="Nomor Invoice"
                                        value="{{ $pelabuhan->barang_import_masuk->no_invoice }}" required />
                                </div>
                            </div>

                            <!-- Nomor Container -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="no_container">Nomor Container</label>
                                    <input type="text" class="form-control" id="no_container" name="no_container"
                                        placeholder="Nomor Container"
                                        value="{{ $pelabuhan->barang_import_masuk->no_container }}" />
                                </div>
                            </div>

                            <!-- Nomor Polisi -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nomor_polisi">Nomor Polisi</label>
                                    <input type="text" class="form-control" id="nomor_polisi" name="no_polisi"
                                        placeholder="Nomor Polisi" required value="{{ $pelabuhan->no_polisi }}" />
                                </div>
                            </div>

                            <!-- Harga Beli -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli </label>
                                    <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                        placeholder="Harga Beli" value="{{ $pelabuhan->items[0]->harga }}" />
                                </div>
                            </div>
                            <!-- Kontak -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="kontak"> Kontak </label>
                                    <input type="number" class="form-control" id="kontak" name="kontak"
                                        placeholder="Kontak" value="{{ $pelabuhan->kontak_supir }}" required />
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
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sales_contract">Sales Contact</label>
                                    <input type="file" class="form-control" id="sales_contract" name="sales_contract">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->sales_contract) }}">Sales
                                            Contract</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="invoice">Invoice</label>
                                    <input type="file" class="form-control" id="invoice" name="invoice">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->invoice) }}">Invoice</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="packing_list">Packing List</label>
                                    <input type="file" class="form-control" id="packing_list" name="packing_list">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->packing_list) }}">Packing
                                            List</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="bill_of_loading">Bill of Lading</label>
                                    <input type="file" class="form-control" id="bill_of_loading"
                                        name="bill_of_loading">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->bill_of_loading) }}">Bill
                                            of Lading</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phytosanitary_certificate">Phytosanitary Certificate</label>
                                    <input type="file" class="form-control" id="phytosanitary_certificate"
                                        name="phytosanitary_certificate">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->phytosanitary_certificate) }}">Phytosanitary
                                            Certificate</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="health_certificate">Health Certificate</label>
                                    <input type="file" class="form-control" id="health_certificate"
                                        name="health_certificate">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->health_certificate) }}">Health
                                            Certificate</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fumigation_certificate">Fumigation</label>
                                    <input type="file" class="form-control" id="fumigation_certificate"
                                        name="fumigation_certificate">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->fumigation_certificate) }}">Fumigation</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="certificate_of_origin">Certificate of Origin</label>
                                    <input type="file" class="form-control" id="certificate_of_origin"
                                        name="certificate_of_origin">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->certificate_of_origin) }}">Certificate
                                            of Origin</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="prior_notice">Prior Notice</label>
                                    <input type="file" class="form-control" id="prior_notice" name="prior_notice">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->prior_notice) }}">Prior
                                            Notice</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="insurance">Insurance</label>
                                    <input type="file" class="form-control" id="insurance" name="insurance">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->insurance) }}">Insurance</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="laporan_surveyor">Laporan Surveyor</label>
                                    <input type="file" class="form-control" id="laporan_surveyor"
                                        name="laporan_surveyor">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->laporan_surveyor) }}">Laporan
                                            Surveyor</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="surat_persetujuan_pengeluaran_barang">Surat Persetujuan Pengeluaran
                                        Barang</label>
                                    <input type="file" class="form-control" id="surat_persetujuan_pengeluaran_barang"
                                        name="surat_persetujuan_pengeluaran_barang">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->surat_persetujuan_pengeluaran_barang) }}">urat
                                            Persetujuan Pengeluaran Barang</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="surat_pengantar_pengeluaran_barang">Surat Pengantar Pengeluaran
                                        Barang</label>
                                    <input type="file" class="form-control" id="surat_pengantar_pengeluaran_barang"
                                        name="surat_pengantar_pengeluaran_barang">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->surat_pengantar_pengeluaran_barang) }}">Surat
                                            Pengantar Pengeluaran Barang</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pemberitahuan_impor_barang">Pemberitahuan Impor Barang</label>
                                    <input type="file" class="form-control" id="pemberitahuan_impor_barang"
                                        name="pemberitahuan_impor_barang">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->pemberitahuan_impor_barang) }}">Pemberitahuan
                                            Impor Barang</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="form-group">
                                    <label for="kt_9">KT-9</label>
                                    <input type="file" class="form-control" id="kt_9"
                                        name="kt_9">
                                    <p>
                                        Default:
                                        <a target="_blank"
                                            href="{{ asset('storage/' . $pelabuhan->import_file->kt_9) }}">KT-9</a>
                                    </p>
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
