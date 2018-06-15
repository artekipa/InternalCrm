@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.company.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.companies.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.company.fields.name').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('adress_address', trans('global.company.fields.adress').'', ['class' => 'control-label']) !!}
                    {!! Form::text('adress_address', old('adress_address'), ['class' => 'form-control map-input', 'id' => 'adress-input']) !!}
                    {!! Form::hidden('adress_latitude', 0 , ['id' => 'adress-latitude']) !!}
                    {!! Form::hidden('adress_longitude', 0 , ['id' => 'adress-longitude']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('adress'))
                        <p class="help-block">
                            {{ $errors->first('adress') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div id="adress-map-container" style="width:100%;height:200px; ">
                <div style="width: 100%; height: 100%" id="adress-map"></div>
            </div>
            @if(!env('GOOGLE_MAPS_API_KEY'))
                <b>'GOOGLE_MAPS_API_KEY' is not set in the .env</b>
            @endif
            
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('persontitle', trans('global.company.fields.persontitle').'', ['class' => 'control-label']) !!}
                    {!! Form::text('persontitle', old('persontitle'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('persontitle'))
                        <p class="help-block">
                            {{ $errors->first('persontitle') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('personname', trans('global.company.fields.personname').'', ['class' => 'control-label']) !!}
                    {!! Form::text('personname', old('personname'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('personname'))
                        <p class="help-block">
                            {{ $errors->first('personname') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('zipcode', trans('global.company.fields.zipcode').'', ['class' => 'control-label']) !!}
                    {!! Form::text('zipcode', old('zipcode'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('zipcode'))
                        <p class="help-block">
                            {{ $errors->first('zipcode') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('city', trans('global.company.fields.city').'', ['class' => 'control-label']) !!}
                    {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('city'))
                        <p class="help-block">
                            {{ $errors->first('city') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vivode_id', trans('global.company.fields.vivode-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-vivode_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-vivode_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('vivode_id[]', $vivode_ids, old('vivode_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-vivode_id' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('vivode_id'))
                        <p class="help-block">
                            {{ $errors->first('vivode_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone', trans('global.company.fields.phone').'', ['class' => 'control-label']) !!}
                    {!! Form::number('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::label('email', trans('global.company.fields.email').'', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::label('website', trans('global.company.fields.website').'', ['class' => 'control-label']) !!}
                    {!! Form::text('website', old('website'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('website'))
                        <p class="help-block">
                            {{ $errors->first('website') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('trades_id', trans('global.company.fields.trades-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-trades_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-trades_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('trades_id[]', $trades_ids, old('trades_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-trades_id' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('trades_id'))
                        <p class="help-block">
                            {{ $errors->first('trades_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('comments', trans('global.company.fields.comments').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('nomination', trans('global.company.fields.nomination').'', ['class' => 'control-label']) !!}
                    {!! Form::text('nomination', old('nomination'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nomination'))
                        <p class="help-block">
                            {{ $errors->first('nomination') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nomiyear_id', trans('global.company.fields.nomiyear-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-nomiyear_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-nomiyear_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('nomiyear_id[]', $nomiyear_ids, old('nomiyear_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-nomiyear_id' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nomiyear_id'))
                        <p class="help-block">
                            {{ $errors->first('nomiyear_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('senddate', trans('global.company.fields.senddate').'', ['class' => 'control-label']) !!}
                    {!! Form::text('senddate', old('senddate'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('senddate'))
                        <p class="help-block">
                            {{ $errors->first('senddate') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('global.company.fields.user').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Nominowane firmy
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.nominated.fields.matrialtype')</th>
                        <th>@lang('global.nominated.fields.materialloc')</th>
                        <th>@lang('global.nominated.fields.sitenumber')</th>
                        <th>@lang('global.nominated.fields.contactperson')</th>
                        <th>@lang('global.nominated.fields.cpemail')</th>
                        <th>@lang('global.nominated.fields.cpphone')</th>
                        <th>@lang('global.nominated.fields.presentation-name')</th>
                        <th>@lang('global.nominated.fields.presentation-site-no')</th>
                        <th>@lang('global.nominated.fields.eventpersonno')</th>
                        <th>@lang('global.nominated.fields.event-person')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="nominowane-firmy">
                    @foreach(old('nominateds', []) as $index => $data)
                        @include('admin.companies.nominateds_row', [
                            'index' => $index
                        ])
                    @endforeach
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
   <script src="/adminlte/js/mapInput.js"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>

    <script type="text/html" id="nominowane-firmy-template">
        @include('admin.companies.nominateds_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 
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
            
            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
    <script>
        $("#selectbtn-vivode_id").click(function(){
            $("#selectall-vivode_id > option").prop("selected","selected");
            $("#selectall-vivode_id").trigger("change");
        });
        $("#deselectbtn-vivode_id").click(function(){
            $("#selectall-vivode_id > option").prop("selected","");
            $("#selectall-vivode_id").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-trades_id").click(function(){
            $("#selectall-trades_id > option").prop("selected","selected");
            $("#selectall-trades_id").trigger("change");
        });
        $("#deselectbtn-trades_id").click(function(){
            $("#selectall-trades_id > option").prop("selected","");
            $("#selectall-trades_id").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-nomiyear_id").click(function(){
            $("#selectall-nomiyear_id > option").prop("selected","selected");
            $("#selectall-nomiyear_id").trigger("change");
        });
        $("#deselectbtn-nomiyear_id").click(function(){
            $("#selectall-nomiyear_id > option").prop("selected","");
            $("#selectall-nomiyear_id").trigger("change");
        });
    </script>
@stop