@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-content-center">
                <h4 class="header-title">{{ ('User List') }}</h4>
                <a class="btn btn-primary btn-sm ml-auto ajax-modal" data-title="{{('Create New User') }}"
                    href="{{ route('users.create') }}"><i class="icofont-plus-circle"></i> {{ ('Add New')
                    }}</a>
            </div>

            <div class="card-body">
                @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">
                    :message
                </div>')) !!}
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <table id="users_table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ ('Name') }}</th>
                            <th>{{ ('Surname') }}</th>
                            <th>{{ ('Username') }}</th>
                            <th>{{ ('Email') }}</th>
                            <th>{{ ('Cell') }}</th>
                            <th>{{ ('Job Title') }}</th>
                            <th>{{ ('Role') }}</th>
                            <th class="text-center">{{ ('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr data-id="row_{{ $user->id }}">
                            <td class='name'>{{ $user->name }}</td>
                            <td class='surname'>{{ $user->surname }}</td>
                            <td class='username'>{{ strtoupper($user->username) }}</td>
                            <td class='email'>{{ $user->email }}</td>
                            <td class='cell'>{{ $user->cell}}</td>
                            <td class='job_title'>{{ $user->job_title }}</td>
                            <td class='role_id'>{{ $user->role->name }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ ('Action') }}
                                    </button>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i
                                                        class="fa-solid fa-pen-to-square"></i>{{ ('Update User') }}</a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ route('users.show', $user->id) }}"><i
                                                        class="fa-solid fa-eye"></i>{{
                                                    ('View
                                                    User') }}</a></li>
                                            <li><button class="btn-remove dropdown-item" type="submit"><i
                                                        class="fa-solid fa-trash-can"></i> {{ ('Delete') }}</button></a>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
