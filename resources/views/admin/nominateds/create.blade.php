@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.nominated.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.nominateds.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('company_id', trans('global.nominated.fields.company').'', ['class' => 'control-label']) !!}
                    {!! Form::select('company_id', $companies, old('company_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('company_id'))
                        <p class="help-block">
                            {{ $errors->first('company_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('programs_id', trans('global.nominated.fields.programs-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-programs_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-programs_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('programs_id[]', $programs_ids, old('programs_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-programs_id' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('programs_id'))
                        <p class="help-block">
                            {{ $errors->first('programs_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_id', trans('global.nominated.fields.project-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-project_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-project_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('project_id[]', $project_ids, old('project_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-project_id' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('project_id'))
                        <p class="help-block">
                            {{ $errors->first('project_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cataward_id', trans('global.nominated.fields.cataward').'', ['class' => 'control-label']) !!}
                    {!! Form::select('cataward_id', $catawards, old('cataward_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cataward_id'))
                        <p class="help-block">
                            {{ $errors->first('cataward_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('award_id', trans('global.nominated.fields.award-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-award_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-award_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('award_id[]', $award_ids, old('award_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-award_id' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('award_id'))
                        <p class="help-block">
                            {{ $errors->first('award_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('year_id', trans('global.nominated.fields.year').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('year_id', $years, old('year_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('year_id'))
                        <p class="help-block">
                            {{ $errors->first('year_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('global.nominated.fields.user-id').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-user_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-user_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('user_id[]', $user_ids, old('user_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-user_id' , 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('materialdates', trans('global.nominated.fields.materialdates').'', ['class' => 'control-label']) !!}
                    {!! Form::text('materialdates', old('materialdates'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('materialdates'))
                        <p class="help-block">
                            {{ $errors->first('materialdates') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('docsdate', trans('global.nominated.fields.docsdate').'', ['class' => 'control-label']) !!}
                    {!! Form::text('docsdate', old('docsdate'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('docsdate'))
                        <p class="help-block">
                            {{ $errors->first('docsdate') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('matrialtype', trans('global.nominated.fields.matrialtype').'', ['class' => 'control-label']) !!}
                    {!! Form::text('matrialtype', old('matrialtype'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('matrialtype'))
                        <p class="help-block">
                            {{ $errors->first('matrialtype') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('materialloc', trans('global.nominated.fields.materialloc').'', ['class' => 'control-label']) !!}
                    {!! Form::text('materialloc', old('materialloc'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('materialloc'))
                        <p class="help-block">
                            {{ $errors->first('materialloc') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('sitenumber', trans('global.nominated.fields.sitenumber').'', ['class' => 'control-label']) !!}
                    {!! Form::number('sitenumber', old('sitenumber'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sitenumber'))
                        <p class="help-block">
                            {{ $errors->first('sitenumber') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('contactperson', trans('global.nominated.fields.contactperson').'', ['class' => 'control-label']) !!}
                    {!! Form::text('contactperson', old('contactperson'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contactperson'))
                        <p class="help-block">
                            {{ $errors->first('contactperson') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cpemail', trans('global.nominated.fields.cpemail').'', ['class' => 'control-label']) !!}
                    {!! Form::email('cpemail', old('cpemail'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cpemail'))
                        <p class="help-block">
                            {{ $errors->first('cpemail') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cpphone', trans('global.nominated.fields.cpphone').'', ['class' => 'control-label']) !!}
                    {!! Form::number('cpphone', old('cpphone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cpphone'))
                        <p class="help-block">
                            {{ $errors->first('cpphone') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('presentation_name', trans('global.nominated.fields.presentation-name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('presentation_name', old('presentation_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('presentation_name'))
                        <p class="help-block">
                            {{ $errors->first('presentation_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('presentation_site_no', trans('global.nominated.fields.presentation-site-no').'', ['class' => 'control-label']) !!}
                    {!! Form::number('presentation_site_no', old('presentation_site_no'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('presentation_site_no'))
                        <p class="help-block">
                            {{ $errors->first('presentation_site_no') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('presentationimg', trans('global.nominated.fields.presentationimg').'', ['class' => 'control-label']) !!}
                    {!! Form::file('presentationimg[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'presentationimg',
                        'data-filekey' => 'presentationimg',
                        ]) !!}
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('presentationimg'))
                        <p class="help-block">
                            {{ $errors->first('presentationimg') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('member', trans('global.nominated.fields.member').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('member', 0) !!}
                    {!! Form::checkbox('member', 1, old('member', false), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('member'))
                        <p class="help-block">
                            {{ $errors->first('member') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('organizations_id', trans('global.nominated.fields.organizations-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-organizations_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-organizations_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('organizations_id[]', $organizations_ids, old('organizations_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-organizations_id' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('organizations_id'))
                        <p class="help-block">
                            {{ $errors->first('organizations_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('docssrc', trans('global.nominated.fields.docssrc').'', ['class' => 'control-label']) !!}
                    {!! Form::file('docssrc[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'docssrc',
                        'data-filekey' => 'docssrc',
                        ]) !!}
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('docssrc'))
                        <p class="help-block">
                            {{ $errors->first('docssrc') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('comments', trans('global.nominated.fields.comments').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('comments', old('comments'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('comments'))
                        <p class="help-block">
                            {{ $errors->first('comments') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('eventpersonno', trans('global.nominated.fields.eventpersonno').'', ['class' => 'control-label']) !!}
                    {!! Form::number('eventpersonno', old('eventpersonno'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('eventpersonno'))
                        <p class="help-block">
                            {{ $errors->first('eventpersonno') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('event_person', trans('global.nominated.fields.event-person').'', ['class' => 'control-label']) !!}
                    {!! Form::text('event_person', old('event_person'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('event_person'))
                        <p class="help-block">
                            {{ $errors->first('event_person') }}
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

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
    <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
        $(function () {
            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'Nominated',
                        bucket: $this.data('bucket'),
                        file_key: $this.data('filekey'),
                        _token: '{{ csrf_token() }}'
                    },
                    add: function (e, data) {
                        data.submit();
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' bytes)').appendTo($parent.find('.files-list')));
                            $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                            $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                            if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                                $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                            }
                            $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                        });
                        $parent.find('.progress-bar').hide().css(
                            'width',
                            '0%'
                        );
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $parent.find('.progress-bar').show().css(
                        'width',
                        progress + '%'
                    );
                });
            });
            $(document).on('click', '.remove-file', function () {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    </script>
    <script>
        $("#selectbtn-programs_id").click(function(){
            $("#selectall-programs_id > option").prop("selected","selected");
            $("#selectall-programs_id").trigger("change");
        });
        $("#deselectbtn-programs_id").click(function(){
            $("#selectall-programs_id > option").prop("selected","");
            $("#selectall-programs_id").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-project_id").click(function(){
            $("#selectall-project_id > option").prop("selected","selected");
            $("#selectall-project_id").trigger("change");
        });
        $("#deselectbtn-project_id").click(function(){
            $("#selectall-project_id > option").prop("selected","");
            $("#selectall-project_id").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-award_id").click(function(){
            $("#selectall-award_id > option").prop("selected","selected");
            $("#selectall-award_id").trigger("change");
        });
        $("#deselectbtn-award_id").click(function(){
            $("#selectall-award_id > option").prop("selected","");
            $("#selectall-award_id").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-user_id").click(function(){
            $("#selectall-user_id > option").prop("selected","selected");
            $("#selectall-user_id").trigger("change");
        });
        $("#deselectbtn-user_id").click(function(){
            $("#selectall-user_id > option").prop("selected","");
            $("#selectall-user_id").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-organizations_id").click(function(){
            $("#selectall-organizations_id > option").prop("selected","selected");
            $("#selectall-organizations_id").trigger("change");
        });
        $("#deselectbtn-organizations_id").click(function(){
            $("#selectall-organizations_id > option").prop("selected","");
            $("#selectall-organizations_id").trigger("change");
        });
    </script>
@stop