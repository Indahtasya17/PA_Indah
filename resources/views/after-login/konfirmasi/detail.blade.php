@extends('layouting.guest.master')

@section('title', 'Detail Konfirmasi')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Barang Masuk</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <p>{{ $pelabuhan->items[0]->barang->nama_barang }}</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label> Tanggal</label>
                            <p>{{ date('d-y-Y', strtotime($pelabuhan->tanggal)) }}</p>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Jumlah Barang</label>
                                <p>
                                    {{ $pelabuhan->items[0]->stock }}
                                    {{  number_format($pelabuhan->items->sum('stock'), 0, ',', '.') }} KG /
                                    {{ $pelabuhan->items->sum('stock') / 1000 }} TON
                                </p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Harga Beli</label>
                                <p>{{ $pelabuhan->items[0]->harga }}</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Nomor Invoice</label>
                                <p>{{ $pelabuhan->barang_import_masuk->no_invoice }}</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Nomor Container</label>
                                <p>{{ $pelabuhan->barang_import_masuk->no_container }}</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Nomor Polisi</label>
                                <p>{{ $pelabuhan->no_polisi }}</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Kontak Supir</label>
                                <p>{{ $pelabuhan->kontak_supir }}</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <p>{{ $pelabuhan->keterangan }}</p>
                            </div>
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
                        <div class="col-4">
                            <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->sales_contract) }}">
                                <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50"
                                    alt="Sales Contract">
                                Sales Contract
                            </a>
                        </div>
                        <div class="col-4">
                            <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->invoice) }}">
                                <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50"
                                    alt="Invoice">
                                Invoice
                            </a>
                        </div>
                        <div class="col-4">
                            <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->packing_list) }}">
                                <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50"
                                    alt="Packing List">
                                Packing List
                            </a>
                        </div>
                        <div class="col-4">
                            <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->bill_of_loading) }}">
                                <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50"
                                    alt="Bill Of Landing">
                                Bill Of Landing
                            </a>
                        </div>
                        <div class="col-4">
                            <a target="_blank"
                                href="{{ asset('storage/' . $pelabuhan->import_file->phytosanitary_certificate) }}">
                                <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50"
                                    alt="Phytosamthing">
                                Phytosamthing
                            </a>
                        </div>
                        <div class="col-4">
                            <a target="_blank" href="{{ asset('storage' . $pelabuhan->import_file->health_certificate) }}">
                                <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50"
                                    alt="Health Certificate">
                                Health Certificate
                            </a>
                        </div>
                        <div class="col-4">
                            <a target="_blank"
                                href="{{ asset('storage/' . $pelabuhan->import_file->fumigation_certificate) }}">
                                <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50"
                                    alt="Fumigation">
                                Fumigation
                            </a>
                        </div>
                        <div class="col-4">
                            <a target="_blank"
                                href="{{ asset('storage/' . $pelabuhan->import_file->certificate_of_origin) }}">
                                <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50"
                                    alt="Certificate of Origin">
                                Certificate of Origin
                            </a>
                        </div>
                        <div class="col-4">
                            <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->prior_notice) }}">
                                <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50"
                                    alt="Prior Nootice">
                                Prior Nootice
                            </a>
                        </div>
                        <div class="col-4">
                            <a target="_blank" href="{{ asset('storage/' . $pelabuhan->import_file->insurance) }}">
                                <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50" height="50"
                                    alt="Insurance">
                                Insurance
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
