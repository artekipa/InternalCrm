@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.advert.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.advert.fields.title')</th>
                            <td field-key='title'>{{ $advert->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.advert.fields.catadver-id')</th>
                            <td field-key='catadver_id'>
                                @foreach ($advert->catadver_id as $singleCatadverId)
                                    <span class="label label-info label-many">{{ $singleCatadverId->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.advert.fields.desc')</th>
                            <td field-key='desc'>{!! $advert->desc !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.advert.fields.team-id')</th>
                            <td field-key='team_id'>
                                @foreach ($advert->team_id as $singleTeamId)
                                    <span class="label label-info label-many">{{ $singleTeamId->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.adverts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
