@extends('layouting.guest.master')

@section('title', 'Detail Pelabuhan')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Barang Masuk</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        {{-- Informasi Barang --}}
                        <div class="col-12 col-md-4">
                            <label>Nama Barang</label>
                            <p>{{ $pelabuhan->items[0]->barang->nama_barang }}</p>
                        </div>

                        <div class="col-12 col-md-4">
                            <label>Jumlah Barang</label>
                            <p>
                                {{ $pelabuhan->items[0]->stock }} Kg /
                                {{ number_format($pelabuhan->items->sum('stock') / 1000, 2, ',', '.') }} TON
                            </p>
                        </div>

                        <div class="col-12 col-md-4">
                            <label>Harga Beli</label>
                            <p>Rp{{ number_format($pelabuhan->items[0]->harga, 0, ',', '.') }}</p>
                        </div>

                        {{-- Informasi Dokumen --}}
                        <div class="col-12 col-md-4">
                            <label>Nomor Invoice</label>
                            <p>{{ $pelabuhan->barang_import_masuk->no_invoice }}</p>
                        </div>

                        <div class="col-12 col-md-4">
                            <label>Tanggal Dikirim</label>
                            <p>{{ date('d-m-Y', strtotime($pelabuhan->tanggal)) }}</p>
                        </div>

                        <div class="col-12 col-md-4">
                            <label>Nomor Container</label>
                            <p>{{ $pelabuhan->barang_import_masuk->no_container }}</p>
                        </div>

                        {{-- Informasi Transportasi --}}
                        <div class="col-12 col-md-4">
                            <label>Nomor Polisi</label>
                            <p>{{ $pelabuhan->no_polisi }}</p>
                        </div>

                        <div class="col-12 col-md-4">
                            <label>Kontak Supir</label>
                            <p>{{ $pelabuhan->kontak_supir }}</p>
                        </div>

                        {{-- Status --}}
                        <div class="col-12 col-md-4">
                            <label>Status</label><br>
                            <span
                                class="badge {{ strtolower($pelabuhan->status) == 'diterima' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($pelabuhan->status) }}
                            </span>
                            @if (strtolower($pelabuhan->status) == 'tidak sesuai')
                                <p>{{ $pelabuhan->riwayat_konfirmasi->last()->keterangan ?? '-' }}</p>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    {{-- @dd($pelabuhan) --}}

    {{-- Detail File (dipindahkan ke bawah) --}}
    <div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail File</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- 1. Sales Contract --}}
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->sales_contract) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Sales Contract">
                            Sales Contract
                        </a>
                    </div>

                    {{-- 2. Invoice --}}
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->invoice) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Invoice">
                            Invoice
                        </a>
                    </div>

                    {{-- 3. Packing List --}}
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->packing_list) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Packing List">
                            Packing List
                        </a>
                    </div>

                    {{-- 4. Bill of Lading --}}
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->bill_of_loading) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Bill of Lading">
                            Bill of Lading
                        </a>
                    </div>

                    {{-- 5. Fumigation --}}
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->fumigation_certificate) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Fumigation">
                            Fumigation
                        </a>
                    </div>

                    {{-- 6. Phytosanitary Certificate --}}
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->phytosanitary_certificate) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Phytosanitary Certificate">
                            Phytosanitary Certificate
                        </a>
                    </div>

                    {{-- 7. Health Certificate --}}
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->health_certificate) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Health Certificate">
                            Health Certificate
                        </a>
                    </div>

                    {{-- 8. Certificate of Origin --}}
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->certificate_of_origin) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Certificate of Origin">
                            Certificate of Origin
                        </a>
                    </div>

                    {{-- 9. Insurance --}}
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->insurance) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Insurance">
                            Insurance
                        </a>
                    </div>

                    {{-- 10. Prior Notice --}}
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->prior_notice) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Prior Notice">
                            Prior Notice
                        </a>
                    </div>
                    
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->laporan_surveyor) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Laporan Surveyo">
                            Laporan Surveyo
                        </a>
                    </div>
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->surat_persetujuan_pengeluaran_barang) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Surat Persetujuan Pengeluaran Barang">
                            Surat Persetujuan Pengeluaran Barang
                        </a>
                    </div>
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->pemberitahuan_impor_barang) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="Pemberitahuan Impor Barang">
                            Pemberitahuan Impor Barang
                        </a>
                    </div>
                    <div class="col-4">
                        <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->kt_9) }}">
                            <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50" alt="KT-9">
                            KT-9
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
