<?php

namespace Modules\Machine\Http\Controllers;

use App\Imports\CategoryImport;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Machine\Entities\Category;
use Modules\Machine\DataTables\MachineCategoriesDataTable;

class CategoriesController extends Controller
{

    public function index(MachineCategoriesDataTable $dataTable) {
        abort_if(Gate::denies('access_machine_categories'), 403);

        return $dataTable->render('machine::categories.index');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('access_machine_categories'), 403);

        $request->validate([
            'category_code' => 'required|unique:categories,category_code',
            'category_name' => 'required'
        ]);

        Category::create([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
        ]);

        toast('machine Category Created!', 'success');

        return redirect()->back();
    }


    public function edit($id) {
        abort_if(Gate::denies('access_machine_categories'), 403);

        $category = Category::findOrFail($id);

        return view('machine::categories.edit', compact('category'));
    }


    public function update(Request $request, $id) {
        abort_if(Gate::denies('access_machine_categories'), 403);

        $request->validate([
            'category_code' => 'required|unique:categories,category_code,' . $id,
            'category_name' => 'required'
        ]);

        Category::findOrFail($id)->update([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
        ]);

        toast('machine Category Updated!', 'info');

        return redirect()->route('machine-categories.index');
    }


    public function destroy($id) {
        abort_if(Gate::denies('access_machine_categories'), 403);

        $category = Category::findOrFail($id);

        if ($category->machines()->exists()) {
            return back()->withErrors('Can\'t delete because there are machines associated with this category.');
        }

        $category->delete();

        toast('machine Category Deleted!', 'warning');

        return redirect()->route('machine-categories.index');
    }

    public function ImportCategory(Request $request) {
        abort_if(Gate::denies('access_machine_categories'), 403);

        
            // Validate the uploaded file
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls,csv'
            ]);
    
            // Get the uploaded file
            $file = $request->file('file');
    
            // Import the data using the DataImport class
            Excel::import(new CategoryImport, $file);
    
            return redirect()->back()->with('success', 'Data imported successfully!');



        //return view('machine-categories.index');
    }
}