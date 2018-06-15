<?php

namespace App\Http\Controllers\Admin;

use App\Catnote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCatnotesRequest;
use App\Http\Requests\Admin\UpdateCatnotesRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class CatnotesController extends Controller
{
    /**
     * Display a listing of Catnote.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('catnote_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Catnote.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Catnote.filter', 'my');
            }
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Catnote.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Catnote.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('catnote_delete')) {
                return abort(401);
            }
            $catnotes = Catnote::onlyTrashed()->get();
        } else {
            $catnotes = Catnote::all();
        }

        return view('admin.catnotes.index', compact('catnotes'));
    }

    /**
     * Show the form for creating new Catnote.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('catnote_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.catnotes.create', compact('created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created Catnote in storage.
     *
     * @param  \App\Http\Requests\StoreCatnotesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCatnotesRequest $request)
    {
        if (! Gate::allows('catnote_create')) {
            return abort(401);
        }
        $catnote = Catnote::create($request->all());



        return redirect()->route('admin.catnotes.index');
    }


    /**
     * Show the form for editing Catnote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('catnote_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $catnote = Catnote::findOrFail($id);

        return view('admin.catnotes.edit', compact('catnote', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update Catnote in storage.
     *
     * @param  \App\Http\Requests\UpdateCatnotesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCatnotesRequest $request, $id)
    {
        if (! Gate::allows('catnote_edit')) {
            return abort(401);
        }
        $catnote = Catnote::findOrFail($id);
        $catnote->update($request->all());



        return redirect()->route('admin.catnotes.index');
    }


    /**
     * Display Catnote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('catnote_view')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$notes = \App\Note::whereHas('catnotes_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $catnote = Catnote::findOrFail($id);

        return view('admin.catnotes.show', compact('catnote', 'notes'));
    }


    /**
     * Remove Catnote from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('catnote_delete')) {
            return abort(401);
        }
        $catnote = Catnote::findOrFail($id);
        $catnote->delete();

        return redirect()->route('admin.catnotes.index');
    }

    /**
     * Delete all selected Catnote at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('catnote_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Catnote::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Catnote from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('catnote_delete')) {
            return abort(401);
        }
        $catnote = Catnote::onlyTrashed()->findOrFail($id);
        $catnote->restore();

        return redirect()->route('admin.catnotes.index');
    }

    /**
     * Permanently delete Catnote from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('catnote_delete')) {
            return abort(401);
        }
        $catnote = Catnote::onlyTrashed()->findOrFail($id);
        $catnote->forceDelete();

        return redirect()->route('admin.catnotes.index');
    }
}
