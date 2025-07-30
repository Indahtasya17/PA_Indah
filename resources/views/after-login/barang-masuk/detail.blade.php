@extends('layouting.guest.master')

@section('title', 'Detail Barang Masuk')
@section('content')
    {{-- @dd($transaksi) --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Detail Barang Masuk
                        {{ $transaksi->sumber_transaksi === 'import' ? 'Import' : 'Lokal' }}</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Tanggal -->
                        <div class="col-12 col-md-6">
                            <label>Tanggal</label>
                            <p class="form-control-plaintext">
                                {{ date('d-m-Y', strtotime($transaksi->tanggal)) }}
                            </p>
                        </div>

                        <!-- Nomor Invoice -->
                        @if ($transaksi->sumber_transaksi == 'import')
                            <div class="col-12 col-md-6">
                                <label>Nomor Invoice</label>
                                <p class="form-control-plaintext">
                                    {{ $transaksi->barang_import_masuk->no_invoice }}
                                </p>
                            </div>
                        @endif

                        <!-- Nomor Polisi -->
                        <div class="col-12 col-md-6">
                            <label>Nomor Polisi</label>
                            <p class="form-control-plaintext">{{ $transaksi->no_polisi }}</p>
                        </div>

                        <!-- Kontak Supir -->
                        <div class="col-12 col-md-6">
                            <label>Kontak Supir</label>
                            <p class="form-control-plaintext">{{ $transaksi->kontak_supir }}</p>
                        </div>

                        <!-- Nomor Kontener -->
                        @if ($transaksi->sumber_transaksi == 'import')
                            <div class="col-12 col-md-6">
                                <label>Nomor Kontener</label>
                                <p class="form-control-plaintext">
                                    {{ $transaksi->barang_import_masuk->no_container }}
                                </p>
                            </div>

                            <!-- Status -->
                            <div class="col-12 col-md-6">
                                <label>Status</label>
                                <span
                                    class="badge {{ strtolower($transaksi->status) == 'diterima' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($transaksi->status) }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail File (dipindahkan ke bawah) --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail File</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if ($transaksi->sumber_transaksi == 'import')
                            <div class="col-4">
                                <a target="_blank" href="{{ asset('storage/' . $transaksi->import_file->Sales_contract) }}">
                                    <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Sales Contract"> Sales Contract </a>
                            </div>
                            <div class="col-4">
                                <a target="_blank" href="{{ asset('storage/' . $transaksi->import_file->invoice) }}">
                                    <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Invoice"> Invoice </a>
                            </div>
                            <div class="col-4">
                                <a target="_blank"
                                    href="{{ asset('storage/' . $transaksi->import_file->bill_of_loading) }}">
                                    <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Bill Of Loading"> Bill Of Loading </a>
                            </div>
                            <div class="col-4">
                                <a target="_blank" href="{{ asset('storage/' . $transaksi->import_file->Packing_list) }}">
                                    <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Packing List"> Packing List </a>
                            </div>
                            <div class="col-4">
                                <a target="_blank" href="{{ asset('storage/' . $transaksi->import_file->Phytosamthing) }}">
                                    <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Phytosamthing"> Phytosamthing </a>
                            </div>
                            <div class="col-4">
                                <a target="_blank"
                                    href="{{ asset('storage/barang-masuk/' . $transaksi->import_file->Helth_certificate) }}">
                                    <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Helth Certificate"> Health Certificate</a>
                            </div>
                            <div class="col-4">
                                <a target="_blank"
                                    href="{{ asset('storage/barang-masuk/' . $transaksi->import_file->Fumigation) }}"><img
                                        src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Fumigation"> Fumigation</a>
                            </div>
                            <div class="col-4">
                                <a target="_blank"
                                    href="{{ asset('storage/barang-masuk/' . $transaksi->import_file->prior_notice) }}"><img
                                        src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Prior Notice"> Prior Notice</a>
                            </div>
                            <div class="col-4">
                                <a target="_blank"
                                    href="{{ asset('storage/barang-masuk/' . $transaksi->import_file->Certificate_of_Origin) }}"><img
                                        src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Certificate of Origin"> Certificate Of Origin</a>
                            </div>
                            <div class="col-4">
                                <a target="_blank"
                                    href="{{ asset('storage/barang-masuk/' . $transaksi->import_file->Insurance) }}"><img
                                        src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Insurance"> Insurance</a>
                            </div>
                            
                            <div class="col-4">
                                <a target="_blank"
                                    href="{{ asset('storage/barang-masuk/' . $transaksi->import_file->laporan_surveyor) }}"><img
                                        src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Laporan Surveyo">
                                    Laporan Surveyo
                                </a>
                            </div>
                            <div class="col-4">
                                <a target="_blank"
                                    href="{{ asset('storage/barang-masuk/' . $transaksi->import_file->surat_persetujuan_pengeluaran_barang) }}">
                                    <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Surat Persetujuan Pengeluaran Barang">
                                    Surat Persetujuan Pengeluaran Barang
                                </a>
                            </div>
                            <div class="col-4">
                                <a target="_blank"
                                    href="{{ asset('storage/barang-masuk/' . $transaksi->import_file->pemberitahuan_impor_barang) }}">
                                    <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="Pemberitahuan Impor Barang">
                                    Pemberitahuan Impor Barang
                                </a>
                            </div>
                            <div class="col-4">
                                <a target="_blank"
                                    href="{{ asset('storage/barang-masuk/' . $transaksi->import_file->kt_9) }}">
                                    <img src="{{ asset('assets/img/icons/document_icon.png') }}" width="50"
                                        height="50" alt="KT-9">
                                    KT-9
                                </a>
                            </div>
                        @else
                            <li>
                                <a target="_blank"
                                    href="{{ asset('storage/barang-masuk/' . $transaksi->file->file) }}">Nota</a>
                            </li>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Barang --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Barang</h4>
                </div>
                <div class="card-body">
                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Harga Beli</th>
                                <th>Subtotal</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($transaksi->items as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        {{ $item->barang->nama_barang }}
                                    </td>
                                    <td>
                                        {{ $item->stock }} Kg
                                        /
                                        {{ $item->stock / 1000 }} Ton
                                    </td>
                                    <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($item->stock * $item->harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection
