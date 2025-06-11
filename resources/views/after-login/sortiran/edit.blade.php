@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Data Barang Sortiran</div>
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
                                            <option value="{{ $barang->id }}" {{ $barang->id == $sortiran->id_barang ? 'selected' : '' }}>{{ $barang->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" name="tanggal" value="{{ $sortiran->tanggal }}"
                                        required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_sortiran">Jumlah Sortiran</label>
                                    <input type="number" class="form-control" id="jumlah_sortiran"
                                        placeholder="Jumlah Sortiran" name="jumlah_sortiran" value="{{ $sortiran->jumlah_sortiran }}" required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_bagus">Jumlah Bagus</label>
                                    <input type="number" class="form-control" id="jumlah_bagus" placeholder="Jumlah Bagus"
                                        name="jumlah_bagus"  value="{{ $sortiran->jumlah_bagus }}" required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_busuk">Jumlah Rusak</label>
                                    <input type="number" class="form-control" id="jumlah_busuk" placeholder="Jumlah Rusak"
                                        name="jumlah_busuk" value="{{ $sortiran->jumlah_busuk }}" required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6" >
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select class="form-select" name="satuan" id="satuan">
                                        <option value="kg" {{ $sortiran->satuan == 'kg' ? 'selected' : '' }}>Kg</option>
                                        <option value="ton" {{ $sortiran->satuan == 'ton' ? 'selected' : '' }}>Ton</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" a href="{{ url()->previous() }}" class="btn btn-danger">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
