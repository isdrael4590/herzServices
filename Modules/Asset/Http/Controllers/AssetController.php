<?php

namespace Modules\Asset\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Asset\DataTables\AssetDataTable;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(AssetDataTable $dataTable) {
        abort_if(Gate::denies('access_asset'), 403);

        return $dataTable->render('asset::asset.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asset::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('asset::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('asset::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
