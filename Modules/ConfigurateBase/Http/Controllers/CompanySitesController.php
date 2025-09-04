<?php

namespace Modules\ConfigurateBase\Http\Controllers;
use Illuminate\Routing\Controller;
use Modules\ConfigurateBase\Entities\CompanySites;
use Illuminate\Http\Request;

use Modules\ConfigurateBase\DataTables\CompanySitesDataTable;

class CompanySitesController extends Controller
{
    /**
     * Display a listing of the resource using DataTables.
     */
    public function index(CompanySitesDataTable $dataTable)
    {
        return $dataTable->render('configuratebase::CompanySites.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentcompany_sites = CompanySites::active()
            ->whereNull('parent_company_sites_id')
            ->orWhereHas('parentCompanySites')
            ->orderBy('name')
            ->get();

        return view('configuratebase::CompanySites.create', compact('parentcompany_sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:company_sites,code',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'parent_company_sites_id' => 'nullable|exists:company_sites,id',
            'status' => 'required|in:active,inactive'
        ]);

        CompanySites::create($request->all());

        return redirect()->route('company_sites.index')
            ->with('success', 'Ubicación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanySites $CompanySites)
    {
        $CompanySites->load(['parentCompanySites', 'childcompany_sites']);
        return view('company_sites.show', compact('CompanySites'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanySites $CompanySites)
    {
        $parentcompany_sites = CompanySites::active()
            ->where('id', '!=', $CompanySites->id)
            ->whereNotIn('id', $CompanySites->getAllChildren()->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('company_sites.edit', compact('CompanySites', 'parentcompany_sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanySites $CompanySites)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:company_sites,code,' . $CompanySites->id,
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'parent_company_sites_id' => 'nullable|exists:company_sites,id',
            'status' => 'required|in:active,inactive'
        ]);

        // Verificar que no se esté asignando como padre a sí mismo o a un descendiente
        if ($request->parent_company_sites_id) {
            $childrenIds = $CompanySites->getAllChildren()->pluck('id')->push($CompanySites->id);
            if ($childrenIds->contains($request->parent_company_sites_id)) {
                return back()->withErrors(['parent_company_sites_id' => 'No se puede asignar como ubicación padre a sí mismo o a un descendiente.']);
            }
        }

        $CompanySites->update($request->all());

        return redirect()->route('company_sites.index')
            ->with('success', 'Ubicación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanySites $CompanySites)
    {
        // Verificar si tiene ubicaciones hijas
        if ($CompanySites->childcompany_sites()->count() > 0) {
            return back()->withErrors(['delete' => 'No se puede eliminar la ubicación porque tiene ubicaciones dependientes.']);
        }

        $CompanySites->delete();

        return redirect()->route('company_sites.index')
            ->with('success', 'Ubicación eliminada exitosamente.');
    }

    /**
     * Cambiar el estado de la ubicación
     */
    public function toggleStatus(CompanySites $CompanySites)
    {
        $CompanySites->update([
            'status' => $CompanySites->status === 'active' ? 'inactive' : 'active'
        ]);

        return back()->with('success', 'Estado de la ubicación actualizado.');
    }

    /**
     * Export company_sites to Excel
     */
    // public function export()
    // {
    //     return Excel::download(new CompanySitesExport, 'ubicaciones_' . date('Y-m-d_H-i-s') . '.xlsx');
    // }

    /**
     * Get company_sites for API or AJAX requests
     */
    public function getcompany_sites(Request $request)
    {
        $company_sites = CompanySites::active();
        
        if ($request->has('parent_id')) {
            $company_sites->where('parent_company_sites_id', $request->parent_id);
        }
        
        if ($request->has('search')) {
            $search = $request->search;
            $company_sites->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('code', 'LIKE', "%{$search}%");
            });
        }
        
        return response()->json($company_sites->get(['id', 'name', 'code', 'parent_company_sites_id']));
    }
}