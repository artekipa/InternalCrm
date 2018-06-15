<?php

namespace App\Http\Controllers\Admin;

use App\Nominated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNominatedsRequest;
use App\Http\Requests\Admin\UpdateNominatedsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class NominatedsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Nominated.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('nominated_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Nominated::query();
            $query->with("company");
            $query->with("programs_id");
            $query->with("project_id");
            $query->with("cataward");
            $query->with("award_id");
            $query->with("year");
            $query->with("user_id");
            $query->with("organizations_id");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('nominated_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'nominateds.id',
                'nominateds.company_id',
                'nominateds.cataward_id',
                'nominateds.year_id',
                'nominateds.materialdates',
                'nominateds.docsdate',
                'nominateds.matrialtype',
                'nominateds.materialloc',
                'nominateds.sitenumber',
                'nominateds.contactperson',
                'nominateds.cpemail',
                'nominateds.cpphone',
                'nominateds.presentation_name',
                'nominateds.presentation_site_no',
                'nominateds.member',
                'nominateds.comments',
                'nominateds.eventpersonno',
                'nominateds.event_person',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'nominated_';
                $routeKey = 'admin.nominateds';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('company.name', function ($row) {
                return $row->company ? $row->company->name : '';
            });
            $table->editColumn('programs_id.name', function ($row) {
                if(count($row->programs_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->programs_id->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('project_id.name', function ($row) {
                if(count($row->project_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->project_id->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('cataward.name', function ($row) {
                return $row->cataward ? $row->cataward->name : '';
            });
            $table->editColumn('award_id.name', function ($row) {
                if(count($row->award_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->award_id->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('year.name', function ($row) {
                return $row->year ? $row->year->name : '';
            });
            $table->editColumn('user_id.name', function ($row) {
                if(count($row->user_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->user_id->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('materialdates', function ($row) {
                return $row->materialdates ? $row->materialdates : '';
            });
            $table->editColumn('docsdate', function ($row) {
                return $row->docsdate ? $row->docsdate : '';
            });
            $table->editColumn('matrialtype', function ($row) {
                return $row->matrialtype ? $row->matrialtype : '';
            });
            $table->editColumn('materialloc', function ($row) {
                return $row->materialloc ? $row->materialloc : '';
            });
            $table->editColumn('sitenumber', function ($row) {
                return $row->sitenumber ? $row->sitenumber : '';
            });
            $table->editColumn('contactperson', function ($row) {
                return $row->contactperson ? $row->contactperson : '';
            });
            $table->editColumn('cpemail', function ($row) {
                return $row->cpemail ? $row->cpemail : '';
            });
            $table->editColumn('cpphone', function ($row) {
                return $row->cpphone ? $row->cpphone : '';
            });
            $table->editColumn('presentation_name', function ($row) {
                return $row->presentation_name ? $row->presentation_name : '';
            });
            $table->editColumn('presentation_site_no', function ($row) {
                return $row->presentation_site_no ? $row->presentation_site_no : '';
            });
            $table->editColumn('presentationimg', function ($row) {
                $build  = '';
                foreach ($row->getMedia('presentationimg') as $media) {
                    $build .= '<p class="form-group"><a href="' . $media->getUrl() . '" target="_blank">' . $media->name . '</a></p>';
                }
                
                return $build;
            });
            $table->editColumn('member', function ($row) {
                return \Form::checkbox("member", 1, $row->member == 1, ["disabled"]);
            });
            $table->editColumn('organizations_id.name', function ($row) {
                if(count($row->organizations_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->organizations_id->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('docssrc', function ($row) {
                $build  = '';
                foreach ($row->getMedia('docssrc') as $media) {
                    $build .= '<p class="form-group"><a href="' . $media->getUrl() . '" target="_blank">' . $media->name . '</a></p>';
                }
                
                return $build;
            });
            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : '';
            });
            $table->editColumn('eventpersonno', function ($row) {
                return $row->eventpersonno ? $row->eventpersonno : '';
            });
            $table->editColumn('event_person', function ($row) {
                return $row->event_person ? $row->event_person : '';
            });

            $table->rawColumns(['actions','massDelete','programs_id.name','project_id.name','award_id.name','user_id.name','member','organizations_id.name']);

            return $table->make(true);
        }

        return view('admin.nominateds.index');
    }

    /**
     * Show the form for creating new Nominated.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('nominated_create')) {
            return abort(401);
        }
        
        $companies = \App\Company::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $programs_ids = \App\Program::get()->pluck('name', 'id');

        $project_ids = \App\Project::get()->pluck('name', 'id');

        $catawards = \App\Cataward::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $award_ids = \App\Award::get()->pluck('name', 'id');

        $years = \App\Year::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $user_ids = \App\User::get()->pluck('name', 'id');

        $organizations_ids = \App\Organization::get()->pluck('name', 'id');


        return view('admin.nominateds.create', compact('companies', 'programs_ids', 'project_ids', 'catawards', 'award_ids', 'years', 'user_ids', 'organizations_ids'));
    }

    /**
     * Store a newly created Nominated in storage.
     *
     * @param  \App\Http\Requests\StoreNominatedsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNominatedsRequest $request)
    {
        if (! Gate::allows('nominated_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $nominated = Nominated::create($request->all());
        $nominated->programs_id()->sync(array_filter((array)$request->input('programs_id')));
        $nominated->project_id()->sync(array_filter((array)$request->input('project_id')));
        $nominated->award_id()->sync(array_filter((array)$request->input('award_id')));
        $nominated->user_id()->sync(array_filter((array)$request->input('user_id')));
        $nominated->organizations_id()->sync(array_filter((array)$request->input('organizations_id')));


        foreach ($request->input('presentationimg_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $nominated->id;
            $file->save();
        }
        foreach ($request->input('docssrc_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $nominated->id;
            $file->save();
        }

        return redirect()->route('admin.nominateds.index');
    }


    /**
     * Show the form for editing Nominated.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('nominated_edit')) {
            return abort(401);
        }
        
        $companies = \App\Company::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $programs_ids = \App\Program::get()->pluck('name', 'id');

        $project_ids = \App\Project::get()->pluck('name', 'id');

        $catawards = \App\Cataward::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $award_ids = \App\Award::get()->pluck('name', 'id');

        $years = \App\Year::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $user_ids = \App\User::get()->pluck('name', 'id');

        $organizations_ids = \App\Organization::get()->pluck('name', 'id');


        $nominated = Nominated::findOrFail($id);

        return view('admin.nominateds.edit', compact('nominated', 'companies', 'programs_ids', 'project_ids', 'catawards', 'award_ids', 'years', 'user_ids', 'organizations_ids'));
    }

    /**
     * Update Nominated in storage.
     *
     * @param  \App\Http\Requests\UpdateNominatedsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNominatedsRequest $request, $id)
    {
        if (! Gate::allows('nominated_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $nominated = Nominated::findOrFail($id);
        $nominated->update($request->all());
        $nominated->programs_id()->sync(array_filter((array)$request->input('programs_id')));
        $nominated->project_id()->sync(array_filter((array)$request->input('project_id')));
        $nominated->award_id()->sync(array_filter((array)$request->input('award_id')));
        $nominated->user_id()->sync(array_filter((array)$request->input('user_id')));
        $nominated->organizations_id()->sync(array_filter((array)$request->input('organizations_id')));


        $media = [];
        foreach ($request->input('presentationimg_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $nominated->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $nominated->updateMedia($media, 'presentationimg');
        $media = [];
        foreach ($request->input('docssrc_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $nominated->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $nominated->updateMedia($media, 'docssrc');

        return redirect()->route('admin.nominateds.index');
    }


    /**
     * Display Nominated.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('nominated_view')) {
            return abort(401);
        }
        $nominated = Nominated::findOrFail($id);

        return view('admin.nominateds.show', compact('nominated'));
    }


    /**
     * Remove Nominated from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('nominated_delete')) {
            return abort(401);
        }
        $nominated = Nominated::findOrFail($id);
        $nominated->deletePreservingMedia();

        return redirect()->route('admin.nominateds.index');
    }

    /**
     * Delete all selected Nominated at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('nominated_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Nominated::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Nominated from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('nominated_delete')) {
            return abort(401);
        }
        $nominated = Nominated::onlyTrashed()->findOrFail($id);
        $nominated->restore();

        return redirect()->route('admin.nominateds.index');
    }

    /**
     * Permanently delete Nominated from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('nominated_delete')) {
            return abort(401);
        }
        $nominated = Nominated::onlyTrashed()->findOrFail($id);
        $nominated->forceDelete();

        return redirect()->route('admin.nominateds.index');
    }
}
