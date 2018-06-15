<?php

namespace App\Http\Controllers\Admin;

use App\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdvertsRequest;
use App\Http\Requests\Admin\UpdateAdvertsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AdvertsController extends Controller
{
    /**
     * Display a listing of Advert.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('advert_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Advert::query();
            $query->with("catadver_id");
            $query->with("team_id");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('advert_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'adverts.id',
                'adverts.title',
                'adverts.desc',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'advert_';
                $routeKey = 'admin.adverts';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('catadver_id.name', function ($row) {
                if(count($row->catadver_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->catadver_id->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('desc', function ($row) {
                return $row->desc ? $row->desc : '';
            });
            $table->editColumn('team_id.name', function ($row) {
                if(count($row->team_id) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->team_id->pluck('name')->toArray()) . '</span>';
            });

            $table->rawColumns(['actions','massDelete','catadver_id.name','team_id.name']);

            return $table->make(true);
        }

        return view('admin.adverts.index');
    }

    /**
     * Show the form for creating new Advert.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('advert_create')) {
            return abort(401);
        }
        
        $catadver_ids = \App\Catadvert::get()->pluck('name', 'id');

        $team_ids = \App\Team::get()->pluck('name', 'id');


        return view('admin.adverts.create', compact('catadver_ids', 'team_ids'));
    }

    /**
     * Store a newly created Advert in storage.
     *
     * @param  \App\Http\Requests\StoreAdvertsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertsRequest $request)
    {
        if (! Gate::allows('advert_create')) {
            return abort(401);
        }
        $advert = Advert::create($request->all());
        $advert->catadver_id()->sync(array_filter((array)$request->input('catadver_id')));
        $advert->team_id()->sync(array_filter((array)$request->input('team_id')));



        return redirect()->route('admin.adverts.index');
    }


    /**
     * Show the form for editing Advert.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('advert_edit')) {
            return abort(401);
        }
        
        $catadver_ids = \App\Catadvert::get()->pluck('name', 'id');

        $team_ids = \App\Team::get()->pluck('name', 'id');


        $advert = Advert::findOrFail($id);

        return view('admin.adverts.edit', compact('advert', 'catadver_ids', 'team_ids'));
    }

    /**
     * Update Advert in storage.
     *
     * @param  \App\Http\Requests\UpdateAdvertsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertsRequest $request, $id)
    {
        if (! Gate::allows('advert_edit')) {
            return abort(401);
        }
        $advert = Advert::findOrFail($id);
        $advert->update($request->all());
        $advert->catadver_id()->sync(array_filter((array)$request->input('catadver_id')));
        $advert->team_id()->sync(array_filter((array)$request->input('team_id')));



        return redirect()->route('admin.adverts.index');
    }


    /**
     * Display Advert.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('advert_view')) {
            return abort(401);
        }
        $advert = Advert::findOrFail($id);

        return view('admin.adverts.show', compact('advert'));
    }


    /**
     * Remove Advert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('advert_delete')) {
            return abort(401);
        }
        $advert = Advert::findOrFail($id);
        $advert->delete();

        return redirect()->route('admin.adverts.index');
    }

    /**
     * Delete all selected Advert at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('advert_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Advert::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Advert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('advert_delete')) {
            return abort(401);
        }
        $advert = Advert::onlyTrashed()->findOrFail($id);
        $advert->restore();

        return redirect()->route('admin.adverts.index');
    }

    /**
     * Permanently delete Advert from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('advert_delete')) {
            return abort(401);
        }
        $advert = Advert::onlyTrashed()->findOrFail($id);
        $advert->forceDelete();

        return redirect()->route('admin.adverts.index');
    }
}
