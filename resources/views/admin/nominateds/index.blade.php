@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.nominated.title')</h3>
    @can('nominated_create')
    <p>
        <a href="{{ route('admin.nominateds.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.nominateds.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.nominateds.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('nominated_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('nominated_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.nominated.fields.company')</th>
                        <th>@lang('global.company.fields.adress')</th>
                        <th>@lang('global.company.fields.persontitle')</th>
                        <th>@lang('global.company.fields.personname')</th>
                        <th>@lang('global.company.fields.zipcode')</th>
                        <th>@lang('global.company.fields.city')</th>
                        <th>@lang('global.company.fields.phone')</th>
                        <th>@lang('global.company.fields.email')</th>
                        <th>@lang('global.company.fields.website')</th>
                        <th>@lang('global.company.fields.comments')</th>
                        <th>@lang('global.company.fields.nomination')</th>
                        <th>@lang('global.company.fields.senddate')</th>
                        <th>@lang('global.nominated.fields.programs-id')</th>
                        <th>@lang('global.nominated.fields.project-id')</th>
                        <th>@lang('global.nominated.fields.cataward')</th>
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
                        <th>@lang('global.nominated.fields.presentationimg')</th>
                        <th>@lang('global.nominated.fields.member')</th>
                        <th>@lang('global.nominated.fields.organizations-id')</th>
                        <th>@lang('global.nominated.fields.docssrc')</th>
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
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('nominated_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.nominateds.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.nominateds.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('nominated_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'company.name', name: 'company.name'},
                {data: 'company.adress', name: 'company.adress'},
                {data: 'company.persontitle', name: 'company.persontitle'},
                {data: 'company.personname', name: 'company.personname'},
                {data: 'company.zipcode', name: 'company.zipcode'},
                {data: 'company.city', name: 'company.city'},
                {data: 'company.phone', name: 'company.phone'},
                {data: 'company.email', name: 'company.email'},
                {data: 'company.website', name: 'company.website'},
                {data: 'company.comments', name: 'company.comments'},
                {data: 'company.nomination', name: 'company.nomination'},
                {data: 'company.senddate', name: 'company.senddate'},
                {data: 'programs_id.name', name: 'programs_id.name'},
                {data: 'project_id.name', name: 'project_id.name'},
                {data: 'cataward.name', name: 'cataward.name'},
                {data: 'award_id.name', name: 'award_id.name'},
                {data: 'year.name', name: 'year.name'},
                {data: 'user_id.name', name: 'user_id.name'},
                {data: 'materialdates', name: 'materialdates'},
                {data: 'docsdate', name: 'docsdate'},
                {data: 'matrialtype', name: 'matrialtype'},
                {data: 'materialloc', name: 'materialloc'},
                {data: 'sitenumber', name: 'sitenumber'},
                {data: 'contactperson', name: 'contactperson'},
                {data: 'cpemail', name: 'cpemail'},
                {data: 'cpphone', name: 'cpphone'},
                {data: 'presentation_name', name: 'presentation_name'},
                {data: 'presentation_site_no', name: 'presentation_site_no'},
                {data: 'presentationimg', name: 'presentationimg'},
                {data: 'member', name: 'member'},
                {data: 'organizations_id.name', name: 'organizations_id.name'},
                {data: 'docssrc', name: 'docssrc'},
                {data: 'comments', name: 'comments'},
                {data: 'eventpersonno', name: 'eventpersonno'},
                {data: 'event_person', name: 'event_person'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection