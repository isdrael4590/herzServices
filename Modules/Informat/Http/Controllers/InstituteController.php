<?php

namespace Modules\Informat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Informat\Entities\Institute;
use Modules\Informat\DataTables\InstituteDataTable;
use Modules\Informat\Http\Requests\StoreInstituteRequest;
use Modules\Informat\Http\Requests\UpdateInstituteRequest;

use Illuminate\Support\Facades\Storage;


class InstituteController extends Controller
{

    public function index(InstituteDataTable $dataTable) {
        abort_if(Gate::denies('access_Informat_institutes'), 403);

        return $dataTable->render('informat::institutes.index');
    }

    public function create() {
        abort_if(Gate::denies('create_institutes'), 403);

        return view('informat::institutes.create');
    }

    public function store(StoreInstituteRequest $request) {
      
        $institute=Institute::create($request->except('document'));

        if ($request->has('document')) {
            foreach ($request->input('document', []) as $file) {
                $institute->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('institutes');
            }
        }

  

        toast('Institución creado!', 'success');

        return redirect()->route('institute.index');
    }

    public function show(Institute $institute) {
        abort_if(Gate::denies('show_institutes'), 403);

        return view('informat::institutes.show', compact('institute'));
    }

    public function edit(Institute $institute) {
        abort_if(Gate::denies('edit_institutes'), 403);


        return view('informat::institutes.edit', compact('institute'));
    }


    public function update(UpdateInstituteRequest $request, Institute $institute) {
        $institute->update($request->except('document'));


        if ($request->has('document')) {
            if (count($institute->getMedia('institutes')) > 0) {
                foreach ($institute->getMedia('institutes') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }

            $media = $institute->getMedia('institutes')->pluck('file_name')->toArray();

            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $institute->addMedia(Storage::path('temp/dropzone/' . $file))->toMediaCollection('institutes');
                }
            }
        }


        toast('Institucion actualizada!', 'info');

        return redirect()->route('institute.index');
    }


    public function destroy($id) {
        abort_if(Gate::denies('delete_institutes'), 403);

        $Institute = Institute::findOrFail($id);

    
        $Institute->delete();

        toast('Institución  Eliminada!', 'warning');

        return redirect()->route('institute.index');
    }
}
