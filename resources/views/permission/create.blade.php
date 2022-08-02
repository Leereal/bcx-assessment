@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <form method="post" id="permissions" class="validate" autocomplete="off"
            action="{{ route('permission.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">{{ ('Select Role') }} </label>
                                    <select class="form-control auto-select select2" data-selected="{{ $role_id }}"
                                        id="role_id" name="role_id" required>
                                        <option value="">{{ ('Select One') }}</option>
                                        @foreach ($roles as $role )
                                        <option value="{{ $role->id }}">{{
                                            ($role->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <span class="d-none panel-title">{{ ('Permission Control') }}</span>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger mb-3" role="alert">
                                :message
                            </div>')) !!}
                            @endif
                            @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            <div id="accordion">
                                @php $i = 1; @endphp
                                @foreach($permission as $key => $val)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4>
                                            <a class="card-link" data-bs-toggle="collapse"
                                                href="#collapse-{{ explode('\\',$key)[3] }}">
                                                <i class="icofont-double-right"></i>
                                                {{ str_replace("Controller","",explode("\\",$key)[3]) }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse-{{ explode('\\',$key)[3] }}" class="collapse">
                                        <div class="card-body">
                                            <table class="table">
                                                @foreach($val as $name => $url)
                                                <tr>
                                                    <td>
                                                        <div class="checkbox">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="permissions[]" value="{{ $name }}"
                                                                    id="customCheck{{ $i + 1 }}" {{
                                                                    array_search($name,$permission_list) !==FALSE
                                                                    ? "checked" : "" }}>
                                                                <label class="custom-control-label"
                                                                    for="customCheck{{ $i + 1 }}">{{
                                                                    str_replace("index","list",$name) }}</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php $i++; @endphp
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg"><i
                                        class="icofont-check-circled"></i> {{ ('Save Permission') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
