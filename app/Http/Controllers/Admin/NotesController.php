<?php

namespace App\Http\Controllers\Admin;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNotesRequest;
use App\Http\Requests\Admin\UpdateNotesRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class NotesController extends Controller
{
    /**
     * Display a listing of Note.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('note_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Note.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Note.filter', 'my');
            }
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Note.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Note.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('note_delete')) {
                return abort(401);
            }
            $notes = Note::onlyTrashed()->get();
        } else {
            $notes = Note::all();
        }

        return view('admin.notes.index', compact('notes'));
    }

    /**
     * Show the form for creating new Note.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('note_create')) {
            return abort(401);
        }
        
        $catnotes_ids = \App\Catnote::get()->pluck('name', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.notes.create', compact('catnotes_ids', 'created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created Note in storage.
     *
     * @param  \App\Http\Requests\StoreNotesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotesRequest $request)
    {
        if (! Gate::allows('note_create')) {
            return abort(401);
        }
        $note = Note::create($request->all());
        $note->catnotes_id()->sync(array_filter((array)$request->input('catnotes_id')));



        return redirect()->route('admin.notes.index');
    }


    /**
     * Show the form for editing Note.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('note_edit')) {
            return abort(401);
        }
        
        $catnotes_ids = \App\Catnote::get()->pluck('name', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $note = Note::findOrFail($id);

        return view('admin.notes.edit', compact('note', 'catnotes_ids', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update Note in storage.
     *
     * @param  \App\Http\Requests\UpdateNotesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotesRequest $request, $id)
    {
        if (! Gate::allows('note_edit')) {
            return abort(401);
        }
        $note = Note::findOrFail($id);
        $note->update($request->all());
        $note->catnotes_id()->sync(array_filter((array)$request->input('catnotes_id')));



        return redirect()->route('admin.notes.index');
    }


    /**
     * Display Note.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('note_view')) {
            return abort(401);
        }
        $note = Note::findOrFail($id);

        return view('admin.notes.show', compact('note'));
    }


    /**
     * Remove Note from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('note_delete')) {
            return abort(401);
        }
        $note = Note::findOrFail($id);
        $note->delete();

        return redirect()->route('admin.notes.index');
    }

    /**
     * Delete all selected Note at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('note_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Note::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Note from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('note_delete')) {
            return abort(401);
        }
        $note = Note::onlyTrashed()->findOrFail($id);
        $note->restore();

        return redirect()->route('admin.notes.index');
    }

    /**
     * Permanently delete Note from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('note_delete')) {
            return abort(401);
        }
        $note = Note::onlyTrashed()->findOrFail($id);
        $note->forceDelete();

        return redirect()->route('admin.notes.index');
    }
}
