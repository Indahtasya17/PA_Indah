@extends('layouting.guest.master')

@section('title', 'Tambah Mitra')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Data Mitra</div>
                </div>

                <form action="{{ route('mitra.store') }}" method="POST">
                    @csrf
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
                                    <input type="text" class="form-control" id="nama" placeholder="Nama"
                                        name="nama" required />
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="kontak">
                                        Kontak Mitra <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="kontak" placeholder="Kontak"
                                        name="kontak" required />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="alamat">
                                        Alamat <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="4" placeholder="Alamat"
                                        required></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('mitra.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
