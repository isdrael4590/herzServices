<?php

namespace Modules\Calendarmtto\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Modules\Calendarmtto\Entities\Calendarmtto;

class CalendarmttoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          

        return view('calendarmtto::index');
    }



 


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('calendarmtto::create');
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
        return view('calendarmtto::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('calendarmtto::edit');
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
