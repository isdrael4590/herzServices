<?php

namespace Modules\Machine\Http\Controllers;

use Modules\Machine\DataTables\MachineDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Machine\Entities\Machine;
use Modules\Machine\Http\Requests\StoreMachineRequest;
use Modules\Machine\Http\Requests\UpdateMachineRequest;
use Modules\Upload\Entities\Upload;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;


class MachineController extends Controller
{

    public function index(MachineDataTable $dataTable)
    {
        abort_if(Gate::denies('access_machines'), 403);

        return $dataTable->render('machine::machines.index');
    }



    public function create()
    {
        abort_if(Gate::denies('create_machines'), 403);

        Cart::instance('machine')->destroy();

        return view('machine::machines.create');
    }


    public function store(StoreMachineRequest $request,)
    {

        DB::transaction(function () use ($request) {
            $machine = Machine::create([

                'machine_name' => $request->machine_name,
                'machine_code' => $request->machine_code,
                'machine_barcode_symbology' => $request->machine_barcode_symbology,
                'machine_unit' => $request->machine_unit,
                'machine_price' => $request->machine_price,
                'area' => $request->area,
                'machine_note' => $request->machine_note,
                'category_id' => $request->category_id,
                'machine_type_process' => $request->machine_type_process,
                'machine_quantity' => $request->machine_quantity,
                'machine_patient' => $request->machine_patient,
            ]);

            if ($request->has('document')) {
                foreach ($request->input('document', []) as $file) {
                    $machine->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                }
            }
            foreach (Cart::instance('machine')->content() as $cart_item) {
                if (($cart_item->qty) >= 3) {
                    $subcode = $request->machine_code . "." . $cart_item->id . "." . $cart_item->qty;
                } else {
                    $subcode = $request->machine_code . "." . $cart_item->id;
                }


      
            }
            Cart::instance('machine')->destroy();
        });
        toast('machineo Creado!', 'success');

        return redirect()->route('machines.index');
    }


    public function show(Machine $machine)
    {
        abort_if(Gate::denies('show_machines'), 403);

        return view('machine::machines.show', compact('machine'));
    }


    public function edit(Machine $machine)
    {
        abort_if(Gate::denies('edit_machines'), 403);
        Cart::instance('machine')->destroy();

        $cart = Cart::instance('machine');




        return view('machine::machines.edit', compact('machine'));
    }


    public function update(UpdateMachineRequest $request, Machine $machine)
    {

        DB::transaction(function () use ($request, $machine) {
            foreach ($machine->submachine as $sub_machine) {
                $sub_machine->delete();
            }
            $machine->update([
                'machine_name' => $request->machine_name,
                'machine_code' => $request->machine_code,
                'machine_barcode_symbology' => $request->machine_barcode_symbology,
                'machine_unit' => $request->machine_unit,
                'area' => $request->area,
                'machine_note' => $request->machine_note,
                'category_id' => $request->category_id,
                'machine_type_process' => $request->machine_type_process,
                'machine_quantity' => $request->machine_quantity,
                'machine_patient' => $request->machine_patient,
            ]);

            if ($request->has('document')) {
                if (count($machine->getMedia('images')) > 0) {
                    foreach ($machine->getMedia('images') as $media) {
                        if (!in_array($media->file_name, $request->input('document', []))) {
                            $media->delete();
                        }
                    }
                }
                $media = $machine->getMedia('images')->pluck('file_name')->toArray();
                foreach ($request->input('document', []) as $file) {
                    if (count($media) === 0 || !in_array($file, $media)) {
                        $machine->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                    }
                }
            }
            foreach (Cart::instance('machine')->content() as $cart_item) {

                if (($cart_item->qty) >= 3) {
                    $subcode = $request->machine_code . "." . $cart_item->id . "." . $cart_item->qty;
                } else {
                    $subcode = $request->machine_code . "." . $cart_item->id;
                }
            
            }
            Cart::instance('machine')->destroy();
        });
        toast('machineo Actualizado!', 'info');
        return redirect()->route('machines.index');
    }


    public function destroy(Machine $machine)
    {
        abort_if(Gate::denies('delete_machines'), 403);
        $machine->delete();
        toast('Equipo Eliminado!', 'warning');
        return redirect()->route('machines.index');
    }
}