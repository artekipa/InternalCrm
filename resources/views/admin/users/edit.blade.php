@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>
    
    {!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.users.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('firstname', trans('global.users.fields.firstname').'', ['class' => 'control-label']) !!}
                    {!! Form::text('firstname', old('firstname'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('firstname'))
                        <p class="help-block">
                            {{ $errors->first('firstname') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('lastname', trans('global.users.fields.lastname').'', ['class' => 'control-label']) !!}
                    {!! Form::text('lastname', old('lastname'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('lastname'))
                        <p class="help-block">
                            {{ $errors->first('lastname') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone', trans('global.users.fields.phone').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($user->avatar)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$user->avatar) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$user->avatar) }}"></a>
                    @endif
                    {!! Form::label('avatar', trans('global.users.fields.avatar').'', ['class' => 'control-label']) !!}
                    {!! Form::file('avatar', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('avatar_max_size', 1) !!}
                    {!! Form::hidden('avatar_max_width', 1200) !!}
                    {!! Form::hidden('avatar_max_height', 1200) !!}
                    <p class="help-block"></p>
                    @if($errors->has('avatar'))
                        <p class="help-block">
                            {{ $errors->first('avatar') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('global.users.fields.email').'*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('password', trans('global.users.fields.password').'*', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('role', trans('global.users.fields.role').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-role">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-role">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('role[]', $roles, old('role') ? old('role') : $user->role->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-role' , 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('role'))
                        <p class="help-block">
                            {{ $errors->first('role') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('codenumber', trans('global.users.fields.codenumber').'', ['class' => 'control-label']) !!}
                    {!! Form::number('codenumber', old('codenumber'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('codenumber'))
                        <p class="help-block">
                            {{ $errors->first('codenumber') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('approved', trans('global.users.fields.approved').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('approved', 0) !!}
                    {!! Form::checkbox('approved', 1, old('approved', old('approved')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('approved'))
                        <p class="help-block">
                            {{ $errors->first('approved') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('team_id', trans('global.users.fields.team').'', ['class' => 'control-label']) !!}
                    {!! Form::select('team_id', $teams, old('team_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('team_id'))
                        <p class="help-block">
                            {{ $errors->first('team_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-role").click(function(){
            $("#selectall-role > option").prop("selected","selected");
            $("#selectall-role").trigger("change");
        });
        $("#deselectbtn-role").click(function(){
            $("#selectall-role > option").prop("selected","");
            $("#selectall-role").trigger("change");
        });
    </script>
@stop