@extends('layouting.guest.master')

@section('title', 'Edit User')
@section('content')
    <form method="POST" action="{{ route('user.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Karyawan</h4>
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
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="{{ old('username', $user->username) }}" required>
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->name }}"
                                                {{ $user->role == $item->name ? 'selected' : '' }}>
                                                {{ $item->name == 'karyawan-gudang' ? 'Karyawan Gudang' : 'Karyawan Pelabuhan' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="card-action mt-3">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('user.index') }}" class="btn btn-danger">Batal</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
