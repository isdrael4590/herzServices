<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class ReportsController extends Controller
{

    public function testbdReport() {
        abort_if(Gate::denies('access_reports'), 403);

        return view('reports::testbd.index');
    }

    public function receptionReport() {
        abort_if(Gate::denies('access_reports'), 403);

        return view('reports::reception.index');
        
    }
    public function dischargeReport() {
        abort_if(Gate::denies('access_reports'), 403);

        return view('reports::discharge.index');
        
    }
    public function expeditionReport() {
        abort_if(Gate::denies('access_reports'), 403);

        return view('reports::expedition.index');
        
    }
}