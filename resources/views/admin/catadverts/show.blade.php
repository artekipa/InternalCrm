@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.catadvert.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.catadvert.fields.name')</th>
                            <td field-key='name'>{{ $catadvert->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#advert" aria-controls="advert" role="tab" data-toggle="tab">Lista ogłoszeń</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="advert">
<table class="table table-bordered table-striped {{ count($adverts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.advert.fields.title')</th>
                        <th>@lang('global.advert.fields.catadver-id')</th>
                        <th>@lang('global.advert.fields.desc')</th>
                        <th>@lang('global.advert.fields.team-id')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($adverts) > 0)
            @foreach ($adverts as $advert)
                <tr data-entry-id="{{ $advert->id }}">
                    <td field-key='title'>{{ $advert->title }}</td>
                                <td field-key='catadver_id'>
                                    @foreach ($advert->catadver_id as $singleCatadverId)
                                        <span class="label label-info label-many">{{ $singleCatadverId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='desc'>{!! $advert->desc !!}</td>
                                <td field-key='team_id'>
                                    @foreach ($advert->team_id as $singleTeamId)
                                        <span class="label label-info label-many">{{ $singleTeamId->name }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['adverts.restore', $advert->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['adverts.perma_del', $advert->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('adverts.show',[$advert->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('adverts.edit',[$advert->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['adverts.destroy', $advert->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.catadverts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
