<?php

namespace App\Http\Controllers\Admin;

use App\Vivodeship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVivodeshipsRequest;
use App\Http\Requests\Admin\UpdateVivodeshipsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VivodeshipsController extends Controller
{
    /**
     * Display a listing of Vivodeship.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('vivodeship_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Vivodeship.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Vivodeship.filter', 'my');
            }
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Vivodeship.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Vivodeship.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('vivodeship_delete')) {
                return abort(401);
            }
            $vivodeships = Vivodeship::onlyTrashed()->get();
        } else {
            $vivodeships = Vivodeship::all();
        }

        return view('admin.vivodeships.index', compact('vivodeships'));
    }

    /**
     * Show the form for creating new Vivodeship.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('vivodeship_create')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.vivodeships.create', compact('created_bies', 'created_by_teams'));
    }

    /**
     * Store a newly created Vivodeship in storage.
     *
     * @param  \App\Http\Requests\StoreVivodeshipsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVivodeshipsRequest $request)
    {
        if (! Gate::allows('vivodeship_create')) {
            return abort(401);
        }
        $vivodeship = Vivodeship::create($request->all());



        return redirect()->route('admin.vivodeships.index');
    }


    /**
     * Show the form for editing Vivodeship.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('vivodeship_edit')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $vivodeship = Vivodeship::findOrFail($id);

        return view('admin.vivodeships.edit', compact('vivodeship', 'created_bies', 'created_by_teams'));
    }

    /**
     * Update Vivodeship in storage.
     *
     * @param  \App\Http\Requests\UpdateVivodeshipsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVivodeshipsRequest $request, $id)
    {
        if (! Gate::allows('vivodeship_edit')) {
            return abort(401);
        }
        $vivodeship = Vivodeship::findOrFail($id);
        $vivodeship->update($request->all());



        return redirect()->route('admin.vivodeships.index');
    }


    /**
     * Display Vivodeship.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('vivodeship_view')) {
            return abort(401);
        }
        
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $created_by_teams = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$companies = \App\Company::whereHas('vivode_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $vivodeship = Vivodeship::findOrFail($id);

        return view('admin.vivodeships.show', compact('vivodeship', 'companies'));
    }


    /**
     * Remove Vivodeship from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('vivodeship_delete')) {
            return abort(401);
        }
        $vivodeship = Vivodeship::findOrFail($id);
        $vivodeship->delete();

        return redirect()->route('admin.vivodeships.index');
    }

    /**
     * Delete all selected Vivodeship at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('vivodeship_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Vivodeship::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Vivodeship from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('vivodeship_delete')) {
            return abort(401);
        }
        $vivodeship = Vivodeship::onlyTrashed()->findOrFail($id);
        $vivodeship->restore();

        return redirect()->route('admin.vivodeships.index');
    }

    /**
     * Permanently delete Vivodeship from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('vivodeship_delete')) {
            return abort(401);
        }
        $vivodeship = Vivodeship::onlyTrashed()->findOrFail($id);
        $vivodeship->forceDelete();

        return redirect()->route('admin.vivodeships.index');
    }
}
