@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.company.title')</h3>
    @can('company_create')
    <p>
        <a href="{{ route('admin.companies.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.companies.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.companies.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($companies) > 0 ? 'datatable' : '' }} @can('company_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('company_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                        <th>@lang('global.users.fields.codenumber')</th>
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
                                @can('company_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
<td field-key='codenumber'>{{ isset($company->user) ? $company->user->codenumber : '' }}</td>
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
@stop

@section('javascript') 
    <script>
        @can('company_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.companies.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection