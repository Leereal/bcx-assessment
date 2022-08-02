@extends('layouts.master')
@section('content')
{{-- Form to capture user details --}}

<div class="row d-flex">
    <div class="col-lg-12 d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-header">
                <h4 class="header-title">{{('Update User') }}</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">
                    :message
                </div>')) !!}

                @endif
                <form method="post" class="validate" autocomplete="off"
                    action="{{ route('users.update', $user->id)  }}">
                    {{ csrf_field()}}
                    <input name="_method" type="hidden" value="PATCH">

                    <div class="form-group row mb-3">
                        <label class="col-xl-3 col-form-label">{{('Name') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-xl-3 col-form-label">{{('Surname') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="surname" value="{{ $user->surname }}"
                                required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-xl-3 col-form-label">{{('Email') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="email" value="{{ $user->email  }}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-xl-3 col-form-label">{{('Cell') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="cell" value="{{ $user->cell }}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-xl-3 col-form-label">{{ ('Password') }}</label>
                        <div class="col-xl-9">
                            <input type="password" class="form-control" name="password" value="" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-xl-3 col-form-label">{{ ('Confirm Password') }}</label>
                        <div class="col-xl-9">
                            <input type="password" class="form-control" name="password_confirmation" value="" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-xl-3 col-form-label">{{ ('Address') }}</label>
                        <div class="col-xl-9">
                            <textarea class="form-control" name="address">{{ $user->address }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-xl-3 col-form-label">{{('Job Title') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="job_title" value="{{ $user->job_title  }}">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-xl-3 col-form-label">{{('Role') }}</label>
                        <div class="col-xl-9">
                            <select name="role" class="form-control auto-select" data-selected="{{ $user->role_id}}"
                                required>
                                <option value="">{{ ('Select Role') }}</option>
                                @foreach ($roles as $role )
                                <option value="{{ $role->id }}">{{
                                    ($role->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xl-9 offset-xl-3">
                            <button type="submit" class="btn btn-primary">{{ ('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
