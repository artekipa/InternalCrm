<?php

namespace App\Http\Controllers\Admin;

use App\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAwardsRequest;
use App\Http\Requests\Admin\UpdateAwardsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AwardsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Award.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('award_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Award.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Award.filter', 'my');
            }
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Award.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Award.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('award_delete')) {
                return abort(401);
            }
            $awards = Award::onlyTrashed()->get();
        } else {
            $awards = Award::all();
        }

        return view('admin.awards.index', compact('awards'));
    }

    /**
     * Show the form for creating new Award.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('award_create')) {
            return abort(401);
        }
        
        $cataward_ids = \App\Cataward::get()->pluck('name', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.awards.create', compact('cataward_ids', 'created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created Award in storage.
     *
     * @param  \App\Http\Requests\StoreAwardsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAwardsRequest $request)
    {
        if (! Gate::allows('award_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $award = Award::create($request->all());
        $award->cataward_id()->sync(array_filter((array)$request->input('cataward_id')));


        foreach ($request->input('imgsrc_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $award->id;
            $file->save();
        }
        foreach ($request->input('docsrc_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $award->id;
            $file->save();
        }

        return redirect()->route('admin.awards.index');
    }


    /**
     * Show the form for editing Award.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('award_edit')) {
            return abort(401);
        }
        
        $cataward_ids = \App\Cataward::get()->pluck('name', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $award = Award::findOrFail($id);

        return view('admin.awards.edit', compact('award', 'cataward_ids', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update Award in storage.
     *
     * @param  \App\Http\Requests\UpdateAwardsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAwardsRequest $request, $id)
    {
        if (! Gate::allows('award_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $award = Award::findOrFail($id);
        $award->update($request->all());
        $award->cataward_id()->sync(array_filter((array)$request->input('cataward_id')));


        $media = [];
        foreach ($request->input('imgsrc_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $award->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $award->updateMedia($media, 'imgsrc');
        $media = [];
        foreach ($request->input('docsrc_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $award->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $award->updateMedia($media, 'docsrc');

        return redirect()->route('admin.awards.index');
    }


    /**
     * Display Award.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('award_view')) {
            return abort(401);
        }
        
        $cataward_ids = \App\Cataward::get()->pluck('name', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$projects = \App\Project::whereHas('awards_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$programs = \App\Program::whereHas('award_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$nominateds = \App\Nominated::whereHas('award_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $award = Award::findOrFail($id);

        return view('admin.awards.show', compact('award', 'projects', 'programs', 'nominateds'));
    }


    /**
     * Remove Award from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('award_delete')) {
            return abort(401);
        }
        $award = Award::findOrFail($id);
        $award->deletePreservingMedia();

        return redirect()->route('admin.awards.index');
    }

    /**
     * Delete all selected Award at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('award_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Award::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Award from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('award_delete')) {
            return abort(401);
        }
        $award = Award::onlyTrashed()->findOrFail($id);
        $award->restore();

        return redirect()->route('admin.awards.index');
    }

    /**
     * Permanently delete Award from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('award_delete')) {
            return abort(401);
        }
        $award = Award::onlyTrashed()->findOrFail($id);
        $award->forceDelete();

        return redirect()->route('admin.awards.index');
    }
}
