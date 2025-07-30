@extends('layouting.guest.master')

@section('title', 'Edit Supplier')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Data Supplier</div>
                </div>
                <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama"
                                        name="nama" value="{{ $supplier->nama }}" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="kontak">Kontak</label>
                                    <input type="text" class="form-control" id="kontak" placeholder="Kontak"
                                        name="kontak" value="{{ $supplier->kontak }}" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Alamat">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="" cols="30" rows="4" placeholder="Alamat"
                                        name="alamat">{{ $supplier->alamat }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
