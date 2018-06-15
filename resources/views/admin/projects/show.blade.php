@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.projects.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.projects.fields.name')</th>
                            <td field-key='name'>{{ $project->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.imgsrc')</th>
                            <td field-key='imgsrc'> @foreach($project->getMedia('imgsrc') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('global.projects.fields.awards-id')</th>
                            <td field-key='awards_id'>
                                @foreach ($project->awards_id as $singleAwardsId)
                                    <span class="label label-info label-many">{{ $singleAwardsId->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#nominated" aria-controls="nominated" role="tab" data-toggle="tab">Nominowane firmy</a></li>
<li role="presentation" class=""><a href="#program" aria-controls="program" role="tab" data-toggle="tab">Programy</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="nominated">
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
<div role="tabpanel" class="tab-pane " id="program">
<table class="table table-bordered table-striped {{ count($programs) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.program.fields.name')</th>
                        <th>@lang('global.program.fields.project-id')</th>
                        <th>@lang('global.program.fields.award-id')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($programs) > 0)
            @foreach ($programs as $program)
                <tr data-entry-id="{{ $program->id }}">
                    <td field-key='name'>{{ $program->name }}</td>
                                <td field-key='imgsrc'>@if($program->imgsrc)<a href="{{ asset(env('UPLOAD_PATH').'/' . $program->imgsrc) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $program->imgsrc) }}"/></a>@endif</td>
                                <td field-key='project_id'>
                                    @foreach ($program->project_id as $singleProjectId)
                                        <span class="label label-info label-many">{{ $singleProjectId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='award_id'>
                                    @foreach ($program->award_id as $singleAwardId)
                                        <span class="label label-info label-many">{{ $singleAwardId->name }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.programs.restore', $program->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.programs.perma_del', $program->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('program_view')
                                    <a href="{{ route('admin.programs.show',[$program->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('program_edit')
                                    <a href="{{ route('admin.programs.edit',[$program->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('program_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.programs.destroy', $program->id])) !!}
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

            <a href="{{ route('admin.projects.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
