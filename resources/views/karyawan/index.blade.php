@extends('layouting.guest.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic</h4>
                </div>
                <div class="card-body">
                    <x-table>
                        @slot('tableHead')
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        @endslot

                        @slot('tableBody')
                            <tr>
                                <td>Name</td>
                                <td>Position</td>
                                <td>Office</td>
                                <td>Age</td>
                                <td>Start date</td>
                                <td>Salary</td>
                            </tr>
                        @endslot
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection
