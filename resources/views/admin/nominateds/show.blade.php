@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.nominated.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.nominated.fields.programs-id')</th>
                            <td field-key='programs_id'>
                                @foreach ($nominated->programs_id as $singleProgramsId)
                                    <span class="label label-info label-many">{{ $singleProgramsId->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.project-id')</th>
                            <td field-key='project_id'>
                                @foreach ($nominated->project_id as $singleProjectId)
                                    <span class="label label-info label-many">{{ $singleProjectId->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.award-id')</th>
                            <td field-key='award_id'>
                                @foreach ($nominated->award_id as $singleAwardId)
                                    <span class="label label-info label-many">{{ $singleAwardId->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.year')</th>
                            <td field-key='year'>{{ $nominated->year->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.user-id')</th>
                            <td field-key='user_id'>
                                @foreach ($nominated->user_id as $singleUserId)
                                    <span class="label label-info label-many">{{ $singleUserId->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.materialdates')</th>
                            <td field-key='materialdates'>{{ $nominated->materialdates }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.docsdate')</th>
                            <td field-key='docsdate'>{{ $nominated->docsdate }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.matrialtype')</th>
                            <td field-key='matrialtype'>{{ $nominated->matrialtype }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.materialloc')</th>
                            <td field-key='materialloc'>{{ $nominated->materialloc }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.sitenumber')</th>
                            <td field-key='sitenumber'>{{ $nominated->sitenumber }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.contactperson')</th>
                            <td field-key='contactperson'>{{ $nominated->contactperson }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.cpemail')</th>
                            <td field-key='cpemail'>{{ $nominated->cpemail }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.cpphone')</th>
                            <td field-key='cpphone'>{{ $nominated->cpphone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.presentation-name')</th>
                            <td field-key='presentation_name'>{{ $nominated->presentation_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.presentation-site-no')</th>
                            <td field-key='presentation_site_no'>{{ $nominated->presentation_site_no }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.presentationimg')</th>
                            <td field-key='presentationimg'> @foreach($nominated->getMedia('presentationimg') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.member')</th>
                            <td field-key='member'>{{ Form::checkbox("member", 1, $nominated->member == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.organizations-id')</th>
                            <td field-key='organizations_id'>
                                @foreach ($nominated->organizations_id as $singleOrganizationsId)
                                    <span class="label label-info label-many">{{ $singleOrganizationsId->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.docssrc')</th>
                            <td field-key='docssrc's> @foreach($nominated->getMedia('docssrc') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.comments')</th>
                            <td field-key='comments'>{!! $nominated->comments !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.eventpersonno')</th>
                            <td field-key='eventpersonno'>{{ $nominated->eventpersonno }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.nominated.fields.event-person')</th>
                            <td field-key='event_person'>{{ $nominated->event_person }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.nominateds.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
