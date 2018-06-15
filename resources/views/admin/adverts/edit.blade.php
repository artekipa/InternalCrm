@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.advert.title')</h3>
    
    {!! Form::model($advert, ['method' => 'PUT', 'route' => ['admin.adverts.update', $advert->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.advert.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('catadver_id', trans('global.advert.fields.catadver-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-catadver_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-catadver_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('catadver_id[]', $catadver_ids, old('catadver_id') ? old('catadver_id') : $advert->catadver_id->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-catadver_id' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('catadver_id'))
                        <p class="help-block">
                            {{ $errors->first('catadver_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('desc', trans('global.advert.fields.desc').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('desc', old('desc'), ['class' => 'form-control editor', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('desc'))
                        <p class="help-block">
                            {{ $errors->first('desc') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('team_id', trans('global.advert.fields.team-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-team_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-team_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('team_id[]', $team_ids, old('team_id') ? old('team_id') : $advert->team_id->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-team_id' ]) !!}
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
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

    <script>
        $("#selectbtn-catadver_id").click(function(){
            $("#selectall-catadver_id > option").prop("selected","selected");
            $("#selectall-catadver_id").trigger("change");
        });
        $("#deselectbtn-catadver_id").click(function(){
            $("#selectall-catadver_id > option").prop("selected","");
            $("#selectall-catadver_id").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-team_id").click(function(){
            $("#selectall-team_id > option").prop("selected","selected");
            $("#selectall-team_id").trigger("change");
        });
        $("#deselectbtn-team_id").click(function(){
            $("#selectall-team_id > option").prop("selected","");
            $("#selectall-team_id").trigger("change");
        });
    </script>
@stop