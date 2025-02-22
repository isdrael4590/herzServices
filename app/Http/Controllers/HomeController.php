<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Discharge\Entities\Discharge;
use Modules\Discharge\Entities\DischargeDetails;
use Modules\Expedition\Entities\Expedition;
use Modules\Informat\Entities\Machine;
use Modules\Labelqr\Entities\Labelqr;
use Modules\Labelqr\Entities\LabelqrDetails;
use Modules\Reception\Entities\Reception;
use Modules\Setting\Entities\Setting;
use Modules\Testbd\Entities\Testbd;
use Modules\Testbd\Entities\Testvacuum;

class HomeController extends Controller
{

    public function index()
    {


        return view('home');
    }

    //Resultado de Mensual Test de Bowie & Dick / Vacío linechart






    // Resultado de Test de Bowie & Dick / Vacío PIECHART



    // Producción Mensual Esterilización.





    // Producción Total Esterilización.

    // Instrumental Procesado.


    // Instrumental Procesado.  old versioon




    // Rendimiento Paquetes



  
}
