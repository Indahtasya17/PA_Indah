@extends('layouting.guest.master')

@section('title', 'Edit Mitra')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Data Mitra</div>
                </div>

                <form action="{{ route('mitra.update', $mitra->id) }}" method="POST">
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
                                    <label for="nama">
                                        Nama Mitra <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nama" name="nama" required
                                        value="{{ old('nama', $mitra->nama) }}" placeholder="Nama">
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="kontak">
                                        Kontak Mitra <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="kontak" name="kontak" required
                                        value="{{ old('kontak', $mitra->kontak) }}" placeholder="Kontak">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="alamat">
                                        Alamat <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="4" required
                                        placeholder="Alamat">{{ old('alamat', $mitra->alamat) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Perbarui</button>
                        <a href="{{ route('mitra.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
