<?php

namespace App\Http\Controllers\Admin;

use App\Catadvert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCatadvertsRequest;
use App\Http\Requests\Admin\UpdateCatadvertsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CatadvertsController extends Controller
{
    /**
     * Display a listing of Catadvert.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('catadvert_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Catadvert::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('catadvert_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'catadverts.id',
                'catadverts.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'catadvert_';
                $routeKey = 'admin.catadverts';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.catadverts.index');
    }

    /**
     * Show the form for creating new Catadvert.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('catadvert_create')) {
            return abort(401);
        }
        return view('admin.catadverts.create');
    }

    /**
     * Store a newly created Catadvert in storage.
     *
     * @param  \App\Http\Requests\StoreCatadvertsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCatadvertsRequest $request)
    {
        if (! Gate::allows('catadvert_create')) {
            return abort(401);
        }
        $catadvert = Catadvert::create($request->all());



        return redirect()->route('admin.catadverts.index');
    }


    /**
     * Show the form for editing Catadvert.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('catadvert_edit')) {
            return abort(401);
        }
        $catadvert = Catadvert::findOrFail($id);

        return view('admin.catadverts.edit', compact('catadvert'));
    }

    /**
     * Update Catadvert in storage.
     *
     * @param  \App\Http\Requests\UpdateCatadvertsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCatadvertsRequest $request, $id)
    {
        if (! Gate::allows('catadvert_edit')) {
            return abort(401);
        }
        $catadvert = Catadvert::findOrFail($id);
        $catadvert->update($request->all());



        return redirect()->route('admin.catadverts.index');
    }


    /**
     * Display Catadvert.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('catadvert_view')) {
            return abort(401);
        }
        $adverts = \App\Advert::whereHas('catadver_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $catadvert = Catadvert::findOrFail($id);

        return view('admin.catadverts.show', compact('catadvert', 'adverts'));
    }


    /**
     * Remove Catadvert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('catadvert_delete')) {
            return abort(401);
        }
        $catadvert = Catadvert::findOrFail($id);
        $catadvert->delete();

        return redirect()->route('admin.catadverts.index');
    }

    /**
     * Delete all selected Catadvert at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('catadvert_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Catadvert::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Catadvert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('catadvert_delete')) {
            return abort(401);
        }
        $catadvert = Catadvert::onlyTrashed()->findOrFail($id);
        $catadvert->restore();

        return redirect()->route('admin.catadverts.index');
    }

    /**
     * Permanently delete Catadvert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('catadvert_delete')) {
            return abort(401);
        }
        $catadvert = Catadvert::onlyTrashed()->findOrFail($id);
        $catadvert->forceDelete();

        return redirect()->route('admin.catadverts.index');
    }
}
