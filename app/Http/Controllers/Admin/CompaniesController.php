<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCompaniesRequest;
use App\Http\Requests\Admin\UpdateCompaniesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CompaniesController extends Controller
{
    /**
     * Display a listing of Company.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('company_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('company_delete')) {
                return abort(401);
            }
            $companies = Company::onlyTrashed()->get();
        } else {
            $companies = Company::all();
        }

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating new Company.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('company_create')) {
            return abort(401);
        }
        
        $vivode_ids = \App\Vivodeship::get()->pluck('name', 'id');

        $trades_ids = \App\Trade::get()->pluck('name', 'id');

        $nomiyear_ids = \App\Year::get()->pluck('name', 'id');

        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.companies.create', compact('vivode_ids', 'trades_ids', 'nomiyear_ids', 'users'));
    }

    /**
     * Store a newly created Company in storage.
     *
     * @param  \App\Http\Requests\StoreCompaniesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompaniesRequest $request)
    {
        if (! Gate::allows('company_create')) {
            return abort(401);
        }
        $company = Company::create($request->all());
        $company->vivode_id()->sync(array_filter((array)$request->input('vivode_id')));
        $company->trades_id()->sync(array_filter((array)$request->input('trades_id')));
        $company->nomiyear_id()->sync(array_filter((array)$request->input('nomiyear_id')));

        foreach ($request->input('nominateds', []) as $data) {
            $company->nominateds()->create($data);
        }


        return redirect()->route('admin.companies.index');
    }


    /**
     * Show the form for editing Company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('company_edit')) {
            return abort(401);
        }
        
        $vivode_ids = \App\Vivodeship::get()->pluck('name', 'id');

        $trades_ids = \App\Trade::get()->pluck('name', 'id');

        $nomiyear_ids = \App\Year::get()->pluck('name', 'id');

        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $company = Company::findOrFail($id);

        return view('admin.companies.edit', compact('company', 'vivode_ids', 'trades_ids', 'nomiyear_ids', 'users'));
    }

    /**
     * Update Company in storage.
     *
     * @param  \App\Http\Requests\UpdateCompaniesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompaniesRequest $request, $id)
    {
        if (! Gate::allows('company_edit')) {
            return abort(401);
        }
        $company = Company::findOrFail($id);
        $company->update($request->all());
        $company->vivode_id()->sync(array_filter((array)$request->input('vivode_id')));
        $company->trades_id()->sync(array_filter((array)$request->input('trades_id')));
        $company->nomiyear_id()->sync(array_filter((array)$request->input('nomiyear_id')));

        $nominateds           = $company->nominateds;
        $currentNominatedData = [];
        foreach ($request->input('nominateds', []) as $index => $data) {
            if (is_integer($index)) {
                $company->nominateds()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentNominatedData[$id] = $data;
            }
        }
        foreach ($nominateds as $item) {
            if (isset($currentNominatedData[$item->id])) {
                $item->update($currentNominatedData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.companies.index');
    }


    /**
     * Display Company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('company_view')) {
            return abort(401);
        }
        
        $vivode_ids = \App\Vivodeship::get()->pluck('name', 'id');

        $trades_ids = \App\Trade::get()->pluck('name', 'id');

        $nomiyear_ids = \App\Year::get()->pluck('name', 'id');

        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$nominateds = \App\Nominated::where('company_id', $id)->get();

        $company = Company::findOrFail($id);

        return view('admin.companies.show', compact('company', 'nominateds'));
    }


    /**
     * Remove Company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('company_delete')) {
            return abort(401);
        }
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('admin.companies.index');
    }

    /**
     * Delete all selected Company at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('company_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Company::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('company_delete')) {
            return abort(401);
        }
        $company = Company::onlyTrashed()->findOrFail($id);
        $company->restore();

        return redirect()->route('admin.companies.index');
    }

    /**
     * Permanently delete Company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('company_delete')) {
            return abort(401);
        }
        $company = Company::onlyTrashed()->findOrFail($id);
        $company->forceDelete();

        return redirect()->route('admin.companies.index');
    }
}
