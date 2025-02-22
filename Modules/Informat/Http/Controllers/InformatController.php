<?php

namespace Modules\Informat\Http\Controllers;

use Modules\Informat\DataTables\InformatDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Modules\Informat\Entities\Informat;
use Modules\Informat\Http\Requests\StoreInformatRequest;
use Modules\Informat\Http\Requests\UpdateInformatRequest;
use Modules\Upload\Entities\Upload;

class InformatController extends Controller
{

    public function index(InformatDataTable $dataTable) {
        abort_if(Gate::denies('access_informats'), 403);

        return $dataTable->render('informat::informats.index');
    }

    public function create() {
        abort_if(Gate::denies('create_informats'), 403);

        return view('informat::informats.create');
    }


    public function store(StoreInformatRequest $request) {
        $informat = Informat::create($request->except('document'));



        toast('informato Creado!', 'success');

        return redirect()->route('informats.index');
    }


    public function show(Informat $informat) {
        abort_if(Gate::denies('show_informats'), 403);

        return view('informat::informats.show', compact('informat'));
    }

    public function edit(Informat $informat) {
        abort_if(Gate::denies('edit_informats'), 403);
        return view('informat::informats.edit', compact('informat'));
    }


    public function update(UpdateInformatRequest $request, Informat $informat) {
        $informat->update($request->except('document'));
        if ($request->has('document')) {
            if (count($informat->getMedia('images')) > 0) {
                foreach ($informat->getMedia('images') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }
            $media = $informat->getMedia('images')->pluck('file_name')->toArray();
            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $informat->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('images');
                }
            }
        }

        toast('informat Updated!', 'info');
        return redirect()->route('informats.index');
    }


    public function destroy(Informat $informat) {
        abort_if(Gate::denies('delete_informats'), 403);
        $informat->delete();
        toast('informat Deleted!', 'warning');
        return redirect()->route('informats.index');
    }
}
