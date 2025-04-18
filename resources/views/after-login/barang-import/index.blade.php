@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Barang Import Masuk</h4>
                        <a href="{{ route('barang-import.masuk.create') }}" class="btn btn-sm btn-primary">Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th>A</th>
                                <th>B</th>
                                <th>c</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            <tr>
                                <td>A</td>
                                <td>B</td>
                                <td>C</td>
                            </tr>
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection
