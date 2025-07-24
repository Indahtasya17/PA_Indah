@extends('layouting.guest.master')

@section('title', 'Edit')
@section('content')
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="card-title">Ganti Password</h4>
                    </div>
                    <div class="card-body">

                        {{-- Notifikasi Sukses --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Tampilkan Error Validasi --}}
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->username }}"
                                        disabled>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password">Password Baru</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" required>
                                </div>

                            </div>
                        </div>
                        <div class="card-action mt-3">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
