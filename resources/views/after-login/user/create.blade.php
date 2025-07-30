@extends('layouting.guest.master')

@section('title', 'Tambah User')
@section('content')
    <form method="POST" action="{{ route('user.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Karyawan Baru</h4>
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
                            <!-- Nama Lengkap -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="username">Role</label>
                                    <select name="" id="" class="form-control">
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->name }}">
                                                {{ $item->name == 'karyawan-gudang' ? 'Karyawan Gudang' : 'Karyawan Pelabuhan' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="card-action mt-3">
                            <button type="submit" class="btn btn-success">Simpan</button> <!-- Hijau -->
                            <a href="{{ route('user.index') }}" class="btn btn-danger">Batal</a> <!-- Merah -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
