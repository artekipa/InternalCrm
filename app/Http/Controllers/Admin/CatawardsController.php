<?php

namespace App\Http\Controllers\Admin;

use App\Cataward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCatawardsRequest;
use App\Http\Requests\Admin\UpdateCatawardsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CatawardsController extends Controller
{
    /**
     * Display a listing of Cataward.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('cataward_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('cataward_delete')) {
                return abort(401);
            }
            $catawards = Cataward::onlyTrashed()->get();
        } else {
            $catawards = Cataward::all();
        }

        return view('admin.catawards.index', compact('catawards'));
    }

    /**
     * Show the form for creating new Cataward.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('cataward_create')) {
            return abort(401);
        }
        return view('admin.catawards.create');
    }

    /**
     * Store a newly created Cataward in storage.
     *
     * @param  \App\Http\Requests\StoreCatawardsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCatawardsRequest $request)
    {
        if (! Gate::allows('cataward_create')) {
            return abort(401);
        }
        $cataward = Cataward::create($request->all());

        foreach ($request->input('nominateds', []) as $data) {
            $cataward->nominateds()->create($data);
        }


        return redirect()->route('admin.catawards.index');
    }


    /**
     * Show the form for editing Cataward.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('cataward_edit')) {
            return abort(401);
        }
        $cataward = Cataward::findOrFail($id);

        return view('admin.catawards.edit', compact('cataward'));
    }

    /**
     * Update Cataward in storage.
     *
     * @param  \App\Http\Requests\UpdateCatawardsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCatawardsRequest $request, $id)
    {
        if (! Gate::allows('cataward_edit')) {
            return abort(401);
        }
        $cataward = Cataward::findOrFail($id);
        $cataward->update($request->all());

        $nominateds           = $cataward->nominateds;
        $currentNominatedData = [];
        foreach ($request->input('nominateds', []) as $index => $data) {
            if (is_integer($index)) {
                $cataward->nominateds()->create($data);
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


        return redirect()->route('admin.catawards.index');
    }


    /**
     * Display Cataward.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('cataward_view')) {
            return abort(401);
        }
        $awards = \App\Award::whereHas('cataward_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$nominateds = \App\Nominated::where('cataward_id', $id)->get();

        $cataward = Cataward::findOrFail($id);

        return view('admin.catawards.show', compact('cataward', 'awards', 'nominateds'));
    }


    /**
     * Remove Cataward from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('cataward_delete')) {
            return abort(401);
        }
        $cataward = Cataward::findOrFail($id);
        $cataward->delete();

        return redirect()->route('admin.catawards.index');
    }

    /**
     * Delete all selected Cataward at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('cataward_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Cataward::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Cataward from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('cataward_delete')) {
            return abort(401);
        }
        $cataward = Cataward::onlyTrashed()->findOrFail($id);
        $cataward->restore();

        return redirect()->route('admin.catawards.index');
    }

    /**
     * Permanently delete Cataward from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('cataward_delete')) {
            return abort(401);
        }
        $cataward = Cataward::onlyTrashed()->findOrFail($id);
        $cataward->forceDelete();

        return redirect()->route('admin.catawards.index');
    }
}
