<?php

namespace App\Http\Controllers\Admin;

use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreYearsRequest;
use App\Http\Requests\Admin\UpdateYearsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class YearsController extends Controller
{
    /**
     * Display a listing of Year.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('year_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Year.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Year.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('year_delete')) {
                return abort(401);
            }
            $years = Year::onlyTrashed()->get();
        } else {
            $years = Year::all();
        }

        return view('admin.years.index', compact('years'));
    }

    /**
     * Show the form for creating new Year.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('year_create')) {
            return abort(401);
        }
        return view('admin.years.create');
    }

    /**
     * Store a newly created Year in storage.
     *
     * @param  \App\Http\Requests\StoreYearsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreYearsRequest $request)
    {
        if (! Gate::allows('year_create')) {
            return abort(401);
        }
        $year = Year::create($request->all());



        return redirect()->route('admin.years.index');
    }


    /**
     * Show the form for editing Year.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('year_edit')) {
            return abort(401);
        }
        $year = Year::findOrFail($id);

        return view('admin.years.edit', compact('year'));
    }

    /**
     * Update Year in storage.
     *
     * @param  \App\Http\Requests\UpdateYearsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateYearsRequest $request, $id)
    {
        if (! Gate::allows('year_edit')) {
            return abort(401);
        }
        $year = Year::findOrFail($id);
        $year->update($request->all());



        return redirect()->route('admin.years.index');
    }


    /**
     * Display Year.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('year_view')) {
            return abort(401);
        }
        $nominateds = \App\Nominated::where('year_id', $id)->get();$companies = \App\Company::whereHas('nomiyear_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $year = Year::findOrFail($id);

        return view('admin.years.show', compact('year', 'nominateds', 'companies'));
    }


    /**
     * Remove Year from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('year_delete')) {
            return abort(401);
        }
        $year = Year::findOrFail($id);
        $year->delete();

        return redirect()->route('admin.years.index');
    }

    /**
     * Delete all selected Year at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('year_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Year::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Year from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('year_delete')) {
            return abort(401);
        }
        $year = Year::onlyTrashed()->findOrFail($id);
        $year->restore();

        return redirect()->route('admin.years.index');
    }

    /**
     * Permanently delete Year from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('year_delete')) {
            return abort(401);
        }
        $year = Year::onlyTrashed()->findOrFail($id);
        $year->forceDelete();

        return redirect()->route('admin.years.index');
    }
}
