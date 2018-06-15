<?php

namespace App\Http\Controllers\Api\V1;

use App\Nominated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNominatedsRequest;
use App\Http\Requests\Admin\UpdateNominatedsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class NominatedsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Nominated::all();
    }

    public function show($id)
    {
        return Nominated::findOrFail($id);
    }

    public function update(UpdateNominatedsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $nominated = Nominated::findOrFail($id);
        $nominated->update($request->all());
        

        return $nominated;
    }

    public function store(StoreNominatedsRequest $request)
    {
        $request = $this->saveFiles($request);
        $nominated = Nominated::create($request->all());
        

        return $nominated;
    }

    public function destroy($id)
    {
        $nominated = Nominated::findOrFail($id);
        $nominated->delete();
        return '';
    }
}
