@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.firstname')</th>
                            <td field-key='firstname'>{{ $user->firstname }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.lastname')</th>
                            <td field-key='lastname'>{{ $user->lastname }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.phone')</th>
                            <td field-key='phone'>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.avatar')</th>
                            <td field-key='avatar'>@if($user->avatar)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->avatar) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $user->avatar) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.created-by')</th>
                            <td field-key='created_by'>{{ $user->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.codenumber')</th>
                            <td field-key='codenumber'>{{ $user->codenumber }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.approved')</th>
                            <td field-key='approved'>{{ Form::checkbox("approved", 1, $user->approved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.team')</th>
                            <td field-key='team'>{{ $user->team->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#task_tags" aria-controls="task_tags" role="tab" data-toggle="tab">Tagi</a></li>
<li role="presentation" class=""><a href="#catnotes" aria-controls="catnotes" role="tab" data-toggle="tab">Kategorie notatek</a></li>
<li role="presentation" class=""><a href="#years" aria-controls="years" role="tab" data-toggle="tab">Lata</a></li>
<li role="presentation" class=""><a href="#vivodeships" aria-controls="vivodeships" role="tab" data-toggle="tab">Województwa</a></li>
<li role="presentation" class=""><a href="#internal_notifications" aria-controls="internal_notifications" role="tab" data-toggle="tab">Notifications</a></li>
<li role="presentation" class=""><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notatki</a></li>
<li role="presentation" class=""><a href="#awards" aria-controls="awards" role="tab" data-toggle="tab">Nagrody</a></li>
<li role="presentation" class=""><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">Lista zadań</a></li>
<li role="presentation" class=""><a href="#nominated" aria-controls="nominated" role="tab" data-toggle="tab">Nominowane firmy</a></li>
<li role="presentation" class=""><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">Lista zadań</a></li>
<li role="presentation" class=""><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
<li role="presentation" class=""><a href="#company" aria-controls="company" role="tab" data-toggle="tab">Firmy</a></li>
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
                                    @can('task_tag_view')
                                    <a href="{{ route('admin.task_tags.show',[$task_tag->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('task_tag_edit')
                                    <a href="{{ route('admin.task_tags.edit',[$task_tag->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('task_tag_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.task_tags.destroy', $task_tag->id])) !!}
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
                                        'route' => ['admin.catnotes.restore', $catnote->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.catnotes.perma_del', $catnote->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('catnote_view')
                                    <a href="{{ route('admin.catnotes.show',[$catnote->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('catnote_edit')
                                    <a href="{{ route('admin.catnotes.edit',[$catnote->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('catnote_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.catnotes.destroy', $catnote->id])) !!}
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
                                        'route' => ['admin.years.restore', $year->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.years.perma_del', $year->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('year_view')
                                    <a href="{{ route('admin.years.show',[$year->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('year_edit')
                                    <a href="{{ route('admin.years.edit',[$year->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('year_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.years.destroy', $year->id])) !!}
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
                                        'route' => ['admin.vivodeships.restore', $vivodeship->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vivodeships.perma_del', $vivodeship->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('vivodeship_view')
                                    <a href="{{ route('admin.vivodeships.show',[$vivodeship->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('vivodeship_edit')
                                    <a href="{{ route('admin.vivodeships.edit',[$vivodeship->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('vivodeship_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vivodeships.destroy', $vivodeship->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="internal_notifications">
<table class="table table-bordered table-striped {{ count($internal_notifications) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.internal-notifications.fields.text')</th>
                        <th>@lang('global.internal-notifications.fields.link')</th>
                        <th>@lang('global.internal-notifications.fields.users')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($internal_notifications) > 0)
            @foreach ($internal_notifications as $internal_notification)
                <tr data-entry-id="{{ $internal_notification->id }}">
                    <td field-key='text'>{{ $internal_notification->text }}</td>
                                <td field-key='link'>{{ $internal_notification->link }}</td>
                                <td field-key='users'>
                                    @foreach ($internal_notification->users as $singleUsers)
                                        <span class="label label-info label-many">{{ $singleUsers->name }}</span>
                                    @endforeach
                                </td>
                                                                <td>
                                    @can('internal_notification_view')
                                    <a href="{{ route('admin.internal_notifications.show',[$internal_notification->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('internal_notification_edit')
                                    <a href="{{ route('admin.internal_notifications.edit',[$internal_notification->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('internal_notification_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.internal_notifications.destroy', $internal_notification->id])) !!}
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
                                        'route' => ['admin.notes.restore', $note->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.notes.perma_del', $note->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('note_view')
                                    <a href="{{ route('admin.notes.show',[$note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('note_edit')
                                    <a href="{{ route('admin.notes.edit',[$note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('note_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.notes.destroy', $note->id])) !!}
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
                                        'route' => ['admin.awards.restore', $award->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.awards.perma_del', $award->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('award_view')
                                    <a href="{{ route('admin.awards.show',[$award->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('award_edit')
                                    <a href="{{ route('admin.awards.edit',[$award->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('award_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.awards.destroy', $award->id])) !!}
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
                                    @can('task_view')
                                    <a href="{{ route('admin.tasks.show',[$task->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('task_edit')
                                    <a href="{{ route('admin.tasks.edit',[$task->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('task_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tasks.destroy', $task->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="nominated">
<table class="table table-bordered table-striped {{ count($nominateds) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.nominated.fields.programs-id')</th>
                        <th>@lang('global.nominated.fields.project-id')</th>
                        <th>@lang('global.nominated.fields.award-id')</th>
                        <th>@lang('global.nominated.fields.year')</th>
                        <th>@lang('global.nominated.fields.user-id')</th>
                        <th>@lang('global.nominated.fields.materialdates')</th>
                        <th>@lang('global.nominated.fields.docsdate')</th>
                        <th>@lang('global.nominated.fields.matrialtype')</th>
                        <th>@lang('global.nominated.fields.materialloc')</th>
                        <th>@lang('global.nominated.fields.sitenumber')</th>
                        <th>@lang('global.nominated.fields.contactperson')</th>
                        <th>@lang('global.nominated.fields.cpemail')</th>
                        <th>@lang('global.nominated.fields.cpphone')</th>
                        <th>@lang('global.nominated.fields.presentation-name')</th>
                        <th>@lang('global.nominated.fields.presentation-site-no')</th>
                        <th>@lang('global.nominated.fields.member')</th>
                        <th>@lang('global.nominated.fields.organizations-id')</th>
                        <th>@lang('global.nominated.fields.comments')</th>
                        <th>@lang('global.nominated.fields.eventpersonno')</th>
                        <th>@lang('global.nominated.fields.event-person')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($nominateds) > 0)
            @foreach ($nominateds as $nominated)
                <tr data-entry-id="{{ $nominated->id }}">
                    <td field-key='programs_id'>
                                    @foreach ($nominated->programs_id as $singleProgramsId)
                                        <span class="label label-info label-many">{{ $singleProgramsId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='project_id'>
                                    @foreach ($nominated->project_id as $singleProjectId)
                                        <span class="label label-info label-many">{{ $singleProjectId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='award_id'>
                                    @foreach ($nominated->award_id as $singleAwardId)
                                        <span class="label label-info label-many">{{ $singleAwardId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='year'>{{ $nominated->year->name or '' }}</td>
                                <td field-key='user_id'>
                                    @foreach ($nominated->user_id as $singleUserId)
                                        <span class="label label-info label-many">{{ $singleUserId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='materialdates'>{{ $nominated->materialdates }}</td>
                                <td field-key='docsdate'>{{ $nominated->docsdate }}</td>
                                <td field-key='matrialtype'>{{ $nominated->matrialtype }}</td>
                                <td field-key='materialloc'>{{ $nominated->materialloc }}</td>
                                <td field-key='sitenumber'>{{ $nominated->sitenumber }}</td>
                                <td field-key='contactperson'>{{ $nominated->contactperson }}</td>
                                <td field-key='cpemail'>{{ $nominated->cpemail }}</td>
                                <td field-key='cpphone'>{{ $nominated->cpphone }}</td>
                                <td field-key='presentation_name'>{{ $nominated->presentation_name }}</td>
                                <td field-key='presentation_site_no'>{{ $nominated->presentation_site_no }}</td>
                                <td field-key='presentationimg'>@if($nominated->presentationimg)<a href="{{ asset(env('UPLOAD_PATH').'/' . $nominated->presentationimg) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $nominated->presentationimg) }}"/></a>@endif</td>
                                <td field-key='member'>{{ Form::checkbox("member", 1, $nominated->member == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='organizations_id'>
                                    @foreach ($nominated->organizations_id as $singleOrganizationsId)
                                        <span class="label label-info label-many">{{ $singleOrganizationsId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='docssrc'>@if($nominated->docssrc)<a href="{{ asset(env('UPLOAD_PATH').'/' . $nominated->docssrc) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='comments'>{!! $nominated->comments !!}</td>
                                <td field-key='eventpersonno'>{{ $nominated->eventpersonno }}</td>
                                <td field-key='event_person'>{{ $nominated->event_person }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.nominateds.restore', $nominated->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.nominateds.perma_del', $nominated->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('nominated_view')
                                    <a href="{{ route('admin.nominateds.show',[$nominated->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('nominated_edit')
                                    <a href="{{ route('admin.nominateds.edit',[$nominated->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('nominated_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.nominateds.destroy', $nominated->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="29">@lang('global.app_no_entries_in_table')</td>
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
                                    @can('task_view')
                                    <a href="{{ route('admin.tasks.show',[$task->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('task_edit')
                                    <a href="{{ route('admin.tasks.edit',[$task->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('task_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tasks.destroy', $task->id])) !!}
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
                                    @can('user_view')
                                    <a href="{{ route('admin.users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ route('admin.users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('user_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.users.destroy', $user->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="company">
<table class="table table-bordered table-striped {{ count($companies) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.company.fields.name')</th>
                        <th>@lang('global.company.fields.adress')</th>
                        <th>@lang('global.company.fields.persontitle')</th>
                        <th>@lang('global.company.fields.personname')</th>
                        <th>@lang('global.company.fields.zipcode')</th>
                        <th>@lang('global.company.fields.city')</th>
                        <th>@lang('global.company.fields.vivode-id')</th>
                        <th>@lang('global.company.fields.phone')</th>
                        <th>@lang('global.company.fields.email')</th>
                        <th>@lang('global.company.fields.website')</th>
                        <th>@lang('global.company.fields.trades-id')</th>
                        <th>@lang('global.company.fields.comments')</th>
                        <th>@lang('global.company.fields.nomination')</th>
                        <th>@lang('global.company.fields.nomiyear-id')</th>
                        <th>@lang('global.company.fields.senddate')</th>
                        <th>@lang('global.company.fields.user')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($companies) > 0)
            @foreach ($companies as $company)
                <tr data-entry-id="{{ $company->id }}">
                    <td field-key='name'>{{ $company->name }}</td>
                                <td field-key='adress'>{{ $company->adress_address }}</td>
                                <td field-key='persontitle'>{{ $company->persontitle }}</td>
                                <td field-key='personname'>{{ $company->personname }}</td>
                                <td field-key='zipcode'>{{ $company->zipcode }}</td>
                                <td field-key='city'>{{ $company->city }}</td>
                                <td field-key='vivode_id'>
                                    @foreach ($company->vivode_id as $singleVivodeId)
                                        <span class="label label-info label-many">{{ $singleVivodeId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='phone'>{{ $company->phone }}</td>
                                <td field-key='email'>{{ $company->email }}</td>
                                <td field-key='website'>{{ $company->website }}</td>
                                <td field-key='trades_id'>
                                    @foreach ($company->trades_id as $singleTradesId)
                                        <span class="label label-info label-many">{{ $singleTradesId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='comments'>{!! $company->comments !!}</td>
                                <td field-key='nomination'>{{ $company->nomination }}</td>
                                <td field-key='nomiyear_id'>
                                    @foreach ($company->nomiyear_id as $singleNomiyearId)
                                        <span class="label label-info label-many">{{ $singleNomiyearId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='senddate'>{{ $company->senddate }}</td>
                                <td field-key='user'>{{ $company->user->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.companies.restore', $company->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.companies.perma_del', $company->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('company_view')
                                    <a href="{{ route('admin.companies.show',[$company->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('company_edit')
                                    <a href="{{ route('admin.companies.edit',[$company->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('company_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.companies.destroy', $company->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="21">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
