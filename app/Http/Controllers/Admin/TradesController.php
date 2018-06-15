<?php

namespace App\Http\Controllers\Admin;

use App\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTradesRequest;
use App\Http\Requests\Admin\UpdateTradesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TradesController extends Controller
{
    /**
     * Display a listing of Trade.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('trade_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('trade_delete')) {
                return abort(401);
            }
            $trades = Trade::onlyTrashed()->get();
        } else {
            $trades = Trade::all();
        }

        return view('admin.trades.index', compact('trades'));
    }

    /**
     * Show the form for creating new Trade.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('trade_create')) {
            return abort(401);
        }
        return view('admin.trades.create');
    }

    /**
     * Store a newly created Trade in storage.
     *
     * @param  \App\Http\Requests\StoreTradesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTradesRequest $request)
    {
        if (! Gate::allows('trade_create')) {
            return abort(401);
        }
        $trade = Trade::create($request->all());



        return redirect()->route('admin.trades.index');
    }


    /**
     * Show the form for editing Trade.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('trade_edit')) {
            return abort(401);
        }
        $trade = Trade::findOrFail($id);

        return view('admin.trades.edit', compact('trade'));
    }

    /**
     * Update Trade in storage.
     *
     * @param  \App\Http\Requests\UpdateTradesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTradesRequest $request, $id)
    {
        if (! Gate::allows('trade_edit')) {
            return abort(401);
        }
        $trade = Trade::findOrFail($id);
        $trade->update($request->all());



        return redirect()->route('admin.trades.index');
    }


    /**
     * Display Trade.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('trade_view')) {
            return abort(401);
        }
        $companies = \App\Company::whereHas('trades_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $trade = Trade::findOrFail($id);

        return view('admin.trades.show', compact('trade', 'companies'));
    }


    /**
     * Remove Trade from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('trade_delete')) {
            return abort(401);
        }
        $trade = Trade::findOrFail($id);
        $trade->delete();

        return redirect()->route('admin.trades.index');
    }

    /**
     * Delete all selected Trade at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('trade_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Trade::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Trade from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('trade_delete')) {
            return abort(401);
        }
        $trade = Trade::onlyTrashed()->findOrFail($id);
        $trade->restore();

        return redirect()->route('admin.trades.index');
    }

    /**
     * Permanently delete Trade from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('trade_delete')) {
            return abort(401);
        }
        $trade = Trade::onlyTrashed()->findOrFail($id);
        $trade->forceDelete();

        return redirect()->route('admin.trades.index');
    }
}
