<?php

namespace App\Http\Controllers\Admin;

use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProgramsRequest;
use App\Http\Requests\Admin\UpdateProgramsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ProgramsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Program.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('program_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('program_delete')) {
                return abort(401);
            }
            $programs = Program::onlyTrashed()->get();
        } else {
            $programs = Program::all();
        }

        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating new Program.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('program_create')) {
            return abort(401);
        }
        
        $project_ids = \App\Project::get()->pluck('name', 'id');

        $award_ids = \App\Award::get()->pluck('name', 'id');


        return view('admin.programs.create', compact('project_ids', 'award_ids'));
    }

    /**
     * Store a newly created Program in storage.
     *
     * @param  \App\Http\Requests\StoreProgramsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramsRequest $request)
    {
        if (! Gate::allows('program_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $program = Program::create($request->all());
        $program->project_id()->sync(array_filter((array)$request->input('project_id')));
        $program->award_id()->sync(array_filter((array)$request->input('award_id')));


        foreach ($request->input('imgsrc_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $program->id;
            $file->save();
        }

        return redirect()->route('admin.programs.index');
    }


    /**
     * Show the form for editing Program.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('program_edit')) {
            return abort(401);
        }
        
        $project_ids = \App\Project::get()->pluck('name', 'id');

        $award_ids = \App\Award::get()->pluck('name', 'id');


        $program = Program::findOrFail($id);

        return view('admin.programs.edit', compact('program', 'project_ids', 'award_ids'));
    }

    /**
     * Update Program in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramsRequest $request, $id)
    {
        if (! Gate::allows('program_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $program = Program::findOrFail($id);
        $program->update($request->all());
        $program->project_id()->sync(array_filter((array)$request->input('project_id')));
        $program->award_id()->sync(array_filter((array)$request->input('award_id')));


        $media = [];
        foreach ($request->input('imgsrc_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $program->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $program->updateMedia($media, 'imgsrc');

        return redirect()->route('admin.programs.index');
    }


    /**
     * Display Program.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('program_view')) {
            return abort(401);
        }
        
        $project_ids = \App\Project::get()->pluck('name', 'id');

        $award_ids = \App\Award::get()->pluck('name', 'id');
$nominateds = \App\Nominated::whereHas('programs_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $program = Program::findOrFail($id);

        return view('admin.programs.show', compact('program', 'nominateds'));
    }


    /**
     * Remove Program from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('program_delete')) {
            return abort(401);
        }
        $program = Program::findOrFail($id);
        $program->deletePreservingMedia();

        return redirect()->route('admin.programs.index');
    }

    /**
     * Delete all selected Program at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('program_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Program::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Program from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('program_delete')) {
            return abort(401);
        }
        $program = Program::onlyTrashed()->findOrFail($id);
        $program->restore();

        return redirect()->route('admin.programs.index');
    }

    /**
     * Permanently delete Program from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('program_delete')) {
            return abort(401);
        }
        $program = Program::onlyTrashed()->findOrFail($id);
        $program->forceDelete();

        return redirect()->route('admin.programs.index');
    }
}
