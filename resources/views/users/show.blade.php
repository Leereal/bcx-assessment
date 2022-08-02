@extends('layouts.master')

@section('content')

<div class="row d-flex">
    <div class="col-lg-12 d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-header">
                <h4 class="header-title">{{$user->name .' '.$user->surname }} Profile</h4>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <td>{{ ('Name') }}</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ ('Surname') }}</td>
                        <td>{{ $user->surname }}</td>
                    </tr>
                    <tr>
                        <td>{{ ('Username') }}</td>
                        <td>{{ strtoupper($user->username) }}</td>
                    </tr>
                    <tr>
                        <td>{{ ('Email') }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>{{ ('Cellphone') }}</td>
                        <td>{{ $user->cell }}</td>
                    </tr>
                    <tr>
                        <td>{{ ('Address') }}</td>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <td>{{ ('Job Title') }}</td>
                        <td>{{ $user->job_title }}</td>
                    </tr>
                    <tr>
                        <td>{{ ('Role') }}</td>
                        <td>{{ $user->role->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
