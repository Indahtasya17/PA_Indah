@extends('layouting.guest.master')

@section('title', 'Edit Sortiran ')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Data Barang Sortiran</div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('sortiran.update', $sortiran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <select class="form-control" id="nama_barang" name="id_barang" required>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}"
                                                {{ $barang->id == $sortiran->id_barang ? 'selected' : '' }}>
                                                {{ $barang->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" name="tanggal"
                                        value="{{ $sortiran->tanggal }}" required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_sortiran">Jumlah Sortiran</label>
                                    <input type="number" class="form-control" id="jumlah_sortiran"
                                        placeholder="Jumlah Sortiran" name="jumlah_sortiran"
                                        value="{{ $sortiran->jumlah_sortiran }}" required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select class="form-select" name="satuan" id="satuan">
                                        <option value="kg" {{ $sortiran->satuan == 'kg' ? 'selected' : '' }}>Kg</option>
                                        <option value="ton" {{ $sortiran->satuan == 'ton' ? 'selected' : '' }}>Ton
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_busuk">Jumlah Rusak</label>
                                    <input type="number" class="form-control" id="jumlah_busuk" placeholder="Jumlah Rusak"
                                        name="jumlah_busuk" value="{{ $sortiran->jumlah_busuk }}" required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_bagus">Jumlah Bagus</label>
                                    <input type="number" class="form-control" id="jumlah_bagus" placeholder="Jumlah Bagus"
                                        name="jumlah_bagus" value="{{ $sortiran->jumlah_bagus }}" readonly />
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-action d-flex gap-2">
                            <button type="submit" class="btn btn-success w-50">Simpan</button>
                            <button type="button" a href="{{ url()->previous() }}"
                                class="btn btn-danger w-50">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function hitungJumlahBagus() {
            const sortiran = parseInt(document.getElementById('jumlah_sortiran').value) || 0;
            const rusak = parseInt(document.getElementById('jumlah_busuk').value) || 0;
            const hasil = sortiran - rusak;
            document.getElementById('jumlah_bagus').value = hasil >= 0 ? hasil : 0;
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('jumlah_sortiran').addEventListener('input', hitungJumlahBagus);
            document.getElementById('jumlah_busuk').addEventListener('input', hitungJumlahBagus);
        });
    </script>
@endpush
