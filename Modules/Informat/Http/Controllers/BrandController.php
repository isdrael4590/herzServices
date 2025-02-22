<?php
namespace Modules\Informat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Informat\Entities\Brand;
use Modules\Informat\DataTables\BrandDataTable;

class BrandController extends Controller
{

    public function index(BrandDataTable $dataTable) {
        abort_if(Gate::denies('access_brands'), 403);

        return $dataTable->render('informat::brands.index');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('create'), 403);

        $request->validate([
            'brand_code' => 'required',
            'brand_name' => 'required',
           // 'brand_identificator' => 'required',
            'brand_model' => 'nullable',
            'brand_type' => 'nullable',
            'brand_serial' => 'nullable',
            'brand_factory' => 'nullable',
            'brand_country' => 'nullable'
        ]);

        Brand::create([
            'brand_code' => $request->brand_code,
            'brand_name' => $request->brand_name,
           //  'brand_identificator' => $request->brand_identificator,
            'brand_model' => $request->brand_model,
            'brand_type' => $request->brand_type,
            'brand_serial' => $request->brand_serial,
            'brand_factory' => $request->brand_factory,
            'brand_country' => $request->brand_country
        ]);

        toast('Equipo creado!', 'success');

        return redirect()->back();
    }


    public function edit($id) {
        abort_if(Gate::denies('edit'), 403);

        $brands = Brand::findOrFail($id);

        return view('informat::brands.edit', compact('brands'));
    }

    public function show(Brand $brand) {
        abort_if(Gate::denies('show'), 403);

        return view('informat::brands.show', compact('brand'));
    }

    public function update(Request $request, $id) {
        abort_if(Gate::denies('edit'), 403);

        $request->validate([
            'brand_code' => 'required|unique:brands,brand_code,' . $id,
            'brand_name' => 'required',
           //  'brand_identificator' => 'required',
            'brand_model' => 'nullable',
            'brand_type' => 'nullable',
            'brand_serial' => 'nullable',
            'brand_factory' => 'nullable',
            'brand_country' => 'nullable'
        ]);

        Brand::findOrFail($id)->update([
            'brand_code' => $request->brand_code,
            'brand_name' => $request->brand_name,
           //  'brand_identificator' => $request->brand_identificator,
            'brand_model' => $request->brand_model,
            'brand_type' => $request->brand_type,
            'brand_serial' => $request->brand_serial,
            'brand_factory' => $request->brand_factory,
            'brand_country' => $request->brand_country
        ]);

        toast('Equipo actualizada!', 'info');

        return redirect()->route('brand.index');
    }


    public function destroy($id) {
        abort_if(Gate::denies('delete'), 403);

        $category = Brand::findOrFail($id);

   

        $category->delete();

        toast('Equipo Eliminado!', 'warning');

        return redirect()->route('brand.index');
    }
}
