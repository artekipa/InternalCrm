@extends('layouts.app')

@section('content')
    <div class="row">
         <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added tasks</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.tasks.fields.name')</th> 
                            <th> @lang('global.tasks.fields.description')</th> 
                            <th> @lang('global.tasks.fields.due-date')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($tasks as $task)
                            <tr>
                               
                                <td>{{ $task->name }} </td> 
                                <td>{{ $task->description }} </td> 
                                <td>{{ $task->due_date }} </td> 
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
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added adverts</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.advert.fields.title')</th> 
                            <th> @lang('global.advert.fields.desc')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($adverts as $advert)
                            <tr>
                               
                                <td>{{ $advert->title }} </td> 
                                <td>{{ $advert->desc }} </td> 
                                <td>

                                    @can('advert_view')
                                    <a href="{{ route('admin.adverts.show',[$advert->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('advert_edit')
                                    <a href="{{ route('admin.adverts.edit',[$advert->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('advert_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.adverts.destroy', $advert->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added nominateds</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.nominated.fields.materialdates')</th> 
                            <th> @lang('global.nominated.fields.docsdate')</th> 
                            <th> @lang('global.nominated.fields.matrialtype')</th> 
                            <th> @lang('global.nominated.fields.materialloc')</th> 
                            <th> @lang('global.nominated.fields.sitenumber')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($nominateds as $nominated)
                            <tr>
                               
                                <td>{{ $nominated->materialdates }} </td> 
                                <td>{{ $nominated->docsdate }} </td> 
                                <td>{{ $nominated->matrialtype }} </td> 
                                <td>{{ $nominated->materialloc }} </td> 
                                <td>{{ $nominated->sitenumber }} </td> 
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
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added companies</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.company.fields.name')</th> 
                            <th> @lang('global.company.fields.persontitle')</th> 
                            <th> @lang('global.company.fields.personname')</th> 
                            <th> @lang('global.company.fields.zipcode')</th> 
                            <th> @lang('global.company.fields.city')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($companies as $company)
                            <tr>
                               
                                <td>{{ $company->name }} </td> 
                                <td>{{ $company->persontitle }} </td> 
                                <td>{{ $company->personname }} </td> 
                                <td>{{ $company->zipcode }} </td> 
                                <td>{{ $company->city }} </td> 
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
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>


    </div>
@endsection

