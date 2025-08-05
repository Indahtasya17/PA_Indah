@extends('layouting.guest.master')

@section('title', 'Tambah Pelabuhan')
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
                                    <x-form-label for="id_barang" :required="true">Nama Barang</x-form-label>
                                    <select name="id_barang" id="id_barang" class="form-control" required>
                                        <option value="">---Pilih Nama Barang---</option>
                                        @foreach ($barangs as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Tanggal -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="tanggal_masuk" :required="true">Tanggal</x-form-label>
                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal" required />
                                </div>
                            </div>

                            <!-- Jumlah Barang -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="Jumlah_Barang" :required="true">Jumlah Barang</x-form-label>
                                    <input type="number" class="form-control" id="Jumlah_Barang" name="jumlah_barang"
                                        placeholder="Jumlah Barang" required />
                                </div>
                            </div>

                            <!-- Satuan -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="satuan" :required="true">Satuan</x-form-label>
                                    <select class="form-select" name="satuan" id="satuan" placeholder="Pilih Satuan"
                                        required>
                                        <option value="">-- Pilih Satuan --</option>
                                        <option value="kg">Kg</option>
                                        <option value="ton">Ton</option>
                                    </select>
                                </div>
                            </div>


                            <!-- Nomor Invoice -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="no_invoice" :required="true">No Invoice</x-form-label>
                                    <input type="text" class="form-control" id="no_invoice" name="no_invoice"
                                        placeholder="Nomor Invoice" required />
                                </div>
                            </div>

                            <!-- Nomor Container -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="no_container" :required="true">Nomor Container</x-form-label>
                                    <input type="text" class="form-control" id="no_container" name="no_container"
                                        placeholder="Nomor Container" required />
                                </div>
                            </div>

                            <!-- Nomor Polisi -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="nomor_polisi" :required="true">Nomor Polisi Truk</x-form-label>
                                    <input type="text" class="form-control" id="nomor_polisi" name="no_polisi"
                                        placeholder="Nomor Polisi" required />
                                </div>
                            </div>

                            <!-- Harga Beli -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="harga_beli" :required="true">Harga Beli</x-form-label>
                                    <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                        placeholder="Harga Beli" required />
                                </div>
                            </div>

                            <!-- Nama Mitra -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="mitra" :required="true">Nama Mitra</x-form-label>
                                    <select name="mitra" id="id_mitra" class="form-control" required>
                                        <option value="">---Pilih Nama Mitra---</option>
                                        @foreach ($mitras as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Kontak Supir -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="kontak" :required="true">Kontak Supir</x-form-label>
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
                        <h4 class="card-title">Tambah Dokumen Import</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="sales_contract" :required="true">Sales Contract</x-form-label>
                                    <input type="file" class="form-control" id="sales_contract"
                                        name="sales_contract" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="invoice" :required="true">Invoice</x-form-label>
                                    <input type="file" class="form-control" id="invoice" name="invoice" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="packing_list" :required="true">Packing List</x-form-label>
                                    <input type="file" class="form-control" id="packing_list" name="packing_list" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="bill_of_loading" :required="true">Bill of Lading</x-form-label>
                                    <input type="file" class="form-control" id="bill_of_loading"
                                        name="bill_of_loading" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="phytosanitary_certificate" :required="true">Phytosanitary
                                        Certificate</x-form-label>
                                    <input type="file" class="form-control" id="phytosanitary_certificate"
                                        name="phytosanitary_certificate" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="health_certificate" :required="true">Health
                                        Certificate</x-form-label>
                                    <input type="file" class="form-control" id="health_certificate"
                                        name="health_certificate" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="fumigation_certificate" :required="true">Fumigation</x-form-label>
                                    <input type="file" class="form-control" id="fumigation_certificate"
                                        name="fumigation_certificate" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="certificate_of_origin" :required="true">Certificate of
                                        Origin</x-form-label>
                                    <input type="file" class="form-control" id="certificate_of_origin"
                                        name="certificate_of_origin" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="prior_notice" :required="true">Prior Notice</x-form-label>
                                    <input type="file" class="form-control" id="prior_notice" name="prior_notice" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="insurance" :required="true">Insurance</x-form-label>
                                    <input type="file" class="form-control" id="insurance" name="insurance" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="laporan_surveyor" :required="true">Laporan Surveyor</x-form-label>
                                    <input type="file" class="form-control" id="laporan_surveyor"
                                        name="laporan_surveyor" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="surat_persetujuan_pengeluaran_barang" :required="true">Surat
                                        Persetujuan Pengeluaran Barang</x-form-label>
                                    <input type="file" class="form-control" id="surat_persetujuan_pengeluaran_barang"
                                        name="surat_persetujuan_pengeluaran_barang" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="surat_pengantar_pengeluaran_barang" :required="true">Surat
                                        Pengantar Pengeluaran Barang</x-form-label>
                                    <input type="file" class="form-control" id="surat_pengantar_pengeluaran_barang"
                                        name="surat_pengantar_pengeluaran_barang" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <x-form-label for="pemberitahuan_impor_barang" :required="true">Pemberitahuan Impor
                                        Barang</x-form-label>
                                    <input type="file" class="form-control" id="pemberitahuan_impor_barang"
                                        name="pemberitahuan_impor_barang" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <x-form-label for="kt_9" :required="true">KT-9</x-form-label>
                                    <input type="file" class="form-control" id="kt_9" name="kt_9" required>
                                </div>
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
