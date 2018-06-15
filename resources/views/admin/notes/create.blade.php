@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.notes.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.notes.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.notes.fields.title').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('desc', trans('global.notes.fields.desc').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('catnotes_id', trans('global.notes.fields.catnotes-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-catnotes_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-catnotes_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('catnotes_id[]', $catnotes_ids, old('catnotes_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-catnotes_id' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('catnotes_id'))
                        <p class="help-block">
                            {{ $errors->first('catnotes_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
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
        $("#selectbtn-catnotes_id").click(function(){
            $("#selectall-catnotes_id > option").prop("selected","selected");
            $("#selectall-catnotes_id").trigger("change");
        });
        $("#deselectbtn-catnotes_id").click(function(){
            $("#selectall-catnotes_id > option").prop("selected","");
            $("#selectall-catnotes_id").trigger("change");
        });
    </script>
@stop