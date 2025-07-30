@extends('layouting.guest.master')

@section('title', 'Kryawan')
@section('content')
    <div class="row">
        <div class="col-md-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Karyawan</h4>
                        <a href="{{ route('user.create') }}" class="btn btn-primary">+ Tambah Karyawan</a>
                    </div>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th class = "text-center">No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @forelse ($users as $key => $user)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        @if ($user->getRoleNames()->first() == 'karyawan-gudang')
                                            Karyawan Gudang
                                        @elseif ($user->getRoleNames()->first() == 'karyawan-pelabuhan')
                                            Karyawan Pelabuhan
                                        @else
                                            Owner
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada karyawan.</td>
                                </tr>
                            @endforelse
                        @endslot
                    </x-table>

                </div>
            </div>
        </div>
    </div>
@endsection
