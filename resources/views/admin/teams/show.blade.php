@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.teams.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.teams.fields.name')</th>
                            <td field-key='name'>{{ $team->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#task_tags" aria-controls="task_tags" role="tab" data-toggle="tab">Tagi</a></li>
<li role="presentation" class=""><a href="#catnotes" aria-controls="catnotes" role="tab" data-toggle="tab">Kategorie notatek</a></li>
<li role="presentation" class=""><a href="#years" aria-controls="years" role="tab" data-toggle="tab">Lata</a></li>
<li role="presentation" class=""><a href="#vivodeships" aria-controls="vivodeships" role="tab" data-toggle="tab">Województwa</a></li>
<li role="presentation" class=""><a href="#advert" aria-controls="advert" role="tab" data-toggle="tab">Lista ogłoszeń</a></li>
<li role="presentation" class=""><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notatki</a></li>
<li role="presentation" class=""><a href="#awards" aria-controls="awards" role="tab" data-toggle="tab">Nagrody</a></li>
<li role="presentation" class=""><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">Lista zadań</a></li>
<li role="presentation" class=""><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="task_tags">
<table class="table table-bordered table-striped {{ count($task_tags) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.task-tags.fields.name')</th>
                        <th>@lang('global.task-tags.fields.created-by')</th>
                        <th>@lang('global.task-tags.fields.created-by-team')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($task_tags) > 0)
            @foreach ($task_tags as $task_tag)
                <tr data-entry-id="{{ $task_tag->id }}">
                    <td field-key='name'>{{ $task_tag->name }}</td>
                                <td field-key='created_by'>{{ $task_tag->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $task_tag->created_by_team->name or '' }}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('task_tags.show',[$task_tag->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('task_tags.edit',[$task_tag->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['task_tags.destroy', $task_tag->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="catnotes">
<table class="table table-bordered table-striped {{ count($catnotes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.catnotes.fields.name')</th>
                        <th>@lang('global.catnotes.fields.created-by')</th>
                        <th>@lang('global.catnotes.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($catnotes) > 0)
            @foreach ($catnotes as $catnote)
                <tr data-entry-id="{{ $catnote->id }}">
                    <td field-key='name'>{{ $catnote->name }}</td>
                                <td field-key='created_by'>{{ $catnote->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $catnote->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['catnotes.restore', $catnote->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['catnotes.perma_del', $catnote->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('catnotes.show',[$catnote->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('catnotes.edit',[$catnote->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['catnotes.destroy', $catnote->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="years">
<table class="table table-bordered table-striped {{ count($years) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.years.fields.name')</th>
                        <th>@lang('global.years.fields.created-by')</th>
                        <th>@lang('global.years.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($years) > 0)
            @foreach ($years as $year)
                <tr data-entry-id="{{ $year->id }}">
                    <td field-key='name'>{{ $year->name }}</td>
                                <td field-key='created_by'>{{ $year->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $year->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['years.restore', $year->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['years.perma_del', $year->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('years.show',[$year->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('years.edit',[$year->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['years.destroy', $year->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="vivodeships">
<table class="table table-bordered table-striped {{ count($vivodeships) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.vivodeships.fields.name')</th>
                        <th>@lang('global.vivodeships.fields.created-by')</th>
                        <th>@lang('global.vivodeships.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($vivodeships) > 0)
            @foreach ($vivodeships as $vivodeship)
                <tr data-entry-id="{{ $vivodeship->id }}">
                    <td field-key='name'>{{ $vivodeship->name }}</td>
                                <td field-key='created_by'>{{ $vivodeship->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $vivodeship->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['vivodeships.restore', $vivodeship->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['vivodeships.perma_del', $vivodeship->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('vivodeships.show',[$vivodeship->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('vivodeships.edit',[$vivodeship->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['vivodeships.destroy', $vivodeship->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="advert">
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
<div role="tabpanel" class="tab-pane " id="notes">
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
<div role="tabpanel" class="tab-pane " id="awards">
<table class="table table-bordered table-striped {{ count($awards) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.awards.fields.name')</th>
                        <th>@lang('global.awards.fields.cataward-id')</th>
                        <th>@lang('global.awards.fields.created-by')</th>
                        <th>@lang('global.awards.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($awards) > 0)
            @foreach ($awards as $award)
                <tr data-entry-id="{{ $award->id }}">
                    <td field-key='name'>{{ $award->name }}</td>
                                <td field-key='cataward_id'>
                                    @foreach ($award->cataward_id as $singleCatawardId)
                                        <span class="label label-info label-many">{{ $singleCatawardId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='imgsrc'>@if($award->imgsrc)<a href="{{ asset(env('UPLOAD_PATH').'/' . $award->imgsrc) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $award->imgsrc) }}"/></a>@endif</td>
                                <td field-key='docsrc'>@if($award->docsrc)<a href="{{ asset(env('UPLOAD_PATH').'/' . $award->docsrc) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='created_by'>{{ $award->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $award->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['awards.restore', $award->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['awards.perma_del', $award->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('awards.show',[$award->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('awards.edit',[$award->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['awards.destroy', $award->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="tasks">
<table class="table table-bordered table-striped {{ count($tasks) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.tasks.fields.name')</th>
                        <th>@lang('global.tasks.fields.description')</th>
                        <th>@lang('global.tasks.fields.status')</th>
                        <th>@lang('global.tasks.fields.tag')</th>
                        <th>@lang('global.tasks.fields.attachment')</th>
                        <th>@lang('global.tasks.fields.due-date')</th>
                        <th>@lang('global.tasks.fields.user')</th>
                        <th>@lang('global.tasks.fields.created-by')</th>
                        <th>@lang('global.tasks.fields.created-by-team')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
                <tr data-entry-id="{{ $task->id }}">
                    <td field-key='name'>{{ $task->name }}</td>
                                <td field-key='description'>{!! $task->description !!}</td>
                                <td field-key='status'>{{ $task->status->name or '' }}</td>
                                <td field-key='tag'>
                                    @foreach ($task->tag as $singleTag)
                                        <span class="label label-info label-many">{{ $singleTag->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='attachment'>@if($task->attachment)<a href="{{ asset(env('UPLOAD_PATH').'/' . $task->attachment) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='due_date'>{{ $task->due_date }}</td>
                                <td field-key='user'>{{ $task->user->name or '' }}</td>
                                <td field-key='created_by'>{{ $task->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $task->created_by_team->name or '' }}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('tasks.show',[$task->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('tasks.edit',[$task->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['tasks.destroy', $task->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="users">
<table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.users.fields.name')</th>
                        <th>@lang('global.users.fields.firstname')</th>
                        <th>@lang('global.users.fields.lastname')</th>
                        <th>@lang('global.users.fields.phone')</th>
                        <th>@lang('global.users.fields.avatar')</th>
                        <th>@lang('global.users.fields.email')</th>
                        <th>@lang('global.users.fields.role')</th>
                        <th>@lang('global.users.fields.created-by')</th>
                        <th>@lang('global.users.fields.codenumber')</th>
                        <th>@lang('global.users.fields.approved')</th>
                        <th>@lang('global.users.fields.team')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($users) > 0)
            @foreach ($users as $user)
                <tr data-entry-id="{{ $user->id }}">
                    <td field-key='name'>{{ $user->name }}</td>
                                <td field-key='firstname'>{{ $user->firstname }}</td>
                                <td field-key='lastname'>{{ $user->lastname }}</td>
                                <td field-key='phone'>{{ $user->phone }}</td>
                                <td field-key='avatar'>@if($user->avatar)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->avatar) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $user->avatar) }}"/></a>@endif</td>
                                <td field-key='email'>{{ $user->email }}</td>
                                <td field-key='role'>
                                    @foreach ($user->role as $singleRole)
                                        <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='created_by'>{{ $user->created_by->name or '' }}</td>
                                <td field-key='codenumber'>{{ $user->codenumber }}</td>
                                <td field-key='approved'>{{ Form::checkbox("approved", 1, $user->approved == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='team'>{{ $user->team->name or '' }}</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="18">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.teams.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
