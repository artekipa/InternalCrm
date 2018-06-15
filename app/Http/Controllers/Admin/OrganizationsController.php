<?php

namespace App\Http\Controllers\Admin;

use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOrganizationsRequest;
use App\Http\Requests\Admin\UpdateOrganizationsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class OrganizationsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Organization.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('organization_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Organization::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('organization_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'organizations.id',
                'organizations.name',
                'organizations.desc',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'organization_';
                $routeKey = 'admin.organizations';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('imgsrc', function ($row) {
                $build  = '';
                foreach ($row->getMedia('imgsrc') as $media) {
                    $build .= '<p class="form-group"><a href="' . $media->getUrl() . '" target="_blank">' . $media->name . '</a></p>';
                }
                
                return $build;
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.organizations.index');
    }

    /**
     * Show the form for creating new Organization.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('organization_create')) {
            return abort(401);
        }
        return view('admin.organizations.create');
    }

    /**
     * Store a newly created Organization in storage.
     *
     * @param  \App\Http\Requests\StoreOrganizationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizationsRequest $request)
    {
        if (! Gate::allows('organization_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $organization = Organization::create($request->all());


        foreach ($request->input('imgsrc_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $organization->id;
            $file->save();
        }

        return redirect()->route('admin.organizations.index');
    }


    /**
     * Show the form for editing Organization.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('organization_edit')) {
            return abort(401);
        }
        $organization = Organization::findOrFail($id);

        return view('admin.organizations.edit', compact('organization'));
    }

    /**
     * Update Organization in storage.
     *
     * @param  \App\Http\Requests\UpdateOrganizationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganizationsRequest $request, $id)
    {
        if (! Gate::allows('organization_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $organization = Organization::findOrFail($id);
        $organization->update($request->all());


        $media = [];
        foreach ($request->input('imgsrc_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $organization->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $organization->updateMedia($media, 'imgsrc');

        return redirect()->route('admin.organizations.index');
    }


    /**
     * Display Organization.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('organization_view')) {
            return abort(401);
        }
        $nominateds = \App\Nominated::whereHas('organizations_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $organization = Organization::findOrFail($id);

        return view('admin.organizations.show', compact('organization', 'nominateds'));
    }


    /**
     * Remove Organization from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('organization_delete')) {
            return abort(401);
        }
        $organization = Organization::findOrFail($id);
        $organization->deletePreservingMedia();

        return redirect()->route('admin.organizations.index');
    }

    /**
     * Delete all selected Organization at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('organization_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Organization::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Organization from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('organization_delete')) {
            return abort(401);
        }
        $organization = Organization::onlyTrashed()->findOrFail($id);
        $organization->restore();

        return redirect()->route('admin.organizations.index');
    }

    /**
     * Permanently delete Organization from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('organization_delete')) {
            return abort(401);
        }
        $organization = Organization::onlyTrashed()->findOrFail($id);
        $organization->forceDelete();

        return redirect()->route('admin.organizations.index');
    }
}
