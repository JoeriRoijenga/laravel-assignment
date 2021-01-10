@extends('layouts.app')

<?php $count = 1; ?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users Overview') }}</div>

                <div class="card-body">
                    @if ($deleted == true)
                        <div class="alert alert-success" role="alert">
                            Succesfully deleted user!
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
                                    E-Mail
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{ $count }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        <form action="/user/edit/{{$user->id}}" method="GET">
                                            <button class="btn btn-info">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/user/delete/{{$user->id}}" method="GET">
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