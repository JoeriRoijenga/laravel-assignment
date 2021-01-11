@extends('layouts.app')

<?php $count = 1; ?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img src="{{ url('storage/' . $logo->path_to_logo) }}" alt="" class="img-thumbnail float-left" style="width:60px; height:60px;">
                    
                    <form action="{{ route('register-view') }}" method="GET">
                        <p class="float-left">{{ __('Users Overview') }}</p>
                        @if(auth()->user()->role == 2)
                            <p class="float-left" style="font-size: 10px"> *Super Admin sees all Users<p>
                        @endif
                        <button class="btn btn-secondary float-right" type="submit">Add User</button>
                    </div>

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
                                    Job
                                </th>
                                <th>
                                    Company
                                </th>
                                <th>
                                    Role
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
                                        {{ $user->title }}
                                    </td>
                                    <td>
                                        {{ $user->company_name }}
                                    </td>
                                    <td>
                                        {{ $user->role == 2 ? "Super Admin" : ($user->role ? "Admin" : "User") }}
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