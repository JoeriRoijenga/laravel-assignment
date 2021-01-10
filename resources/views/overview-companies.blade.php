@extends('layouts.app')

<?php $count = 1; ?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Companies Overview') }}</div>

                <div class="card-body">
                    @if ($deleted == true)
                        <div class="alert alert-success" role="alert">
                            Succesfully deleted company!
                        </div>                   
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                            </tr>
                            @foreach($companies as $company)
                                <tr>
                                    <td>
                                        {{ $count }}
                                    </td>
                                    <td>
                                        {{ $company->company_name }}
                                    </td>
                                    <td>
                                        {{ $company->street }} {{ $company->housenumber }}, {{ $company->zip }}, {{ $company->city }}
                                    </td>
                                    <td>
                                        <form action="/company/edit/{{$company->company_id}}" method="GET">
                                            <button class="btn btn-info">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/company/delete/{{$company->company_id}}" method="GET">
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $count++; ?>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection