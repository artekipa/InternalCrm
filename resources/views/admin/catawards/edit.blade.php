@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.catawards.title')</h3>
    
    {!! Form::model($cataward, ['method' => 'PUT', 'route' => ['admin.catawards.update', $cataward->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.catawards.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
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
                    @forelse(old('nominateds', []) as $index => $data)
                        @include('admin.catawards.nominateds_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($cataward->nominateds as $item)
                            @include('admin.catawards.nominateds_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="nominowane-firmy-template">
        @include('admin.catawards.nominateds_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

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
@stop