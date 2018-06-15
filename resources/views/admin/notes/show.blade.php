@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.notes.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.notes.fields.title')</th>
                            <td field-key='title'>{{ $note->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.notes.fields.desc')</th>
                            <td field-key='desc'>{!! $note->desc !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.notes.fields.catnotes-id')</th>
                            <td field-key='catnotes_id'>
                                @foreach ($note->catnotes_id as $singleCatnotesId)
                                    <span class="label label-info label-many">{{ $singleCatnotesId->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.notes.fields.created-by')</th>
                            <td field-key='created_by'>{{ $note->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.notes.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $note->created_by_team->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.notes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
