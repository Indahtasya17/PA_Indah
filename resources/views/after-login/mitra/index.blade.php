@extends('layouting.guest.master')

@section('title', 'Data Mitra')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Mitra</h4>
                        @hasanyrole('karyawan-gudang')
                        <a href="{{ route('mitra.create') }}" class="btn btn-primary">+ Tambah Mitra</a>
                        @endhasanyrole
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                @hasanyrole('karyawan-gudang')
                                <th class="text-center">Aksi</th>
                                @endhasanyrole
                            </tr>
                        @endslot

                        @slot('tableBody')
                            @foreach ($mitras as $key => $mitra)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $mitra->nama }}</td>
                                    <td>{{ $mitra->kontak }}</td>
                                    <td>{{ $mitra->alamat }}</td>
                                    @hasanyrole('karyawan-gudang')
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a class="btn btn-sm btn-success" href="{{ route('mitra.edit', $mitra->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('mitra.destroy', $mitra->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus mitra ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    @endhasanyrole
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection
