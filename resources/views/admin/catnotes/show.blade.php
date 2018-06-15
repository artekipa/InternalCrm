@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.catnotes.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.catnotes.fields.name')</th>
                            <td field-key='name'>{{ $catnote->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.catnotes.fields.created-by')</th>
                            <td field-key='created_by'>{{ $catnote->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.catnotes.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $catnote->created_by_team->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notatki</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="notes">
<table class="table table-bordered table-striped {{ count($notes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.notes.fields.title')</th>
                        <th>@lang('global.notes.fields.desc')</th>
                        <th>@lang('global.notes.fields.catnotes-id')</th>
                        <th>@lang('global.notes.fields.created-by')</th>
                        <th>@lang('global.notes.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($notes) > 0)
            @foreach ($notes as $note)
                <tr data-entry-id="{{ $note->id }}">
                    <td field-key='title'>{{ $note->title }}</td>
                                <td field-key='desc'>{!! $note->desc !!}</td>
                                <td field-key='catnotes_id'>
                                    @foreach ($note->catnotes_id as $singleCatnotesId)
                                        <span class="label label-info label-many">{{ $singleCatnotesId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='created_by'>{{ $note->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $note->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['notes.restore', $note->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['notes.perma_del', $note->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('notes.show',[$note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('notes.edit',[$note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['notes.destroy', $note->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.catnotes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
