<?php

namespace Modules\ConfigurateBase\Entities;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySites extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'address',
        'city',
        'country',
        'parent_company_sites_id',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    // Relación con la ubicación padre
    public function parentCompanySites()
    {
        return $this->belongsTo(CompanySites::class, 'parent_company_sites_id');
    }

    // Relación con las ubicaciones hijas
    public function childCompanySites()
    {
        return $this->hasMany(CompanySites::class, 'parent_company_sites_id');
    }

    // Scope para ubicaciones activas
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope para ubicaciones inactivas
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    // Accessor para obtener el nombre completo con jerarquía
    public function getFullNameAttribute()
    {
        $names = collect([$this->name]);
        $parent = $this->parentCompanySites;
        
        while ($parent) {
            $names->prepend($parent->name);
            $parent = $parent->parentCompanySites;
        }
        
        return $names->implode(' > ');
    }

    // Método para obtener todas las ubicaciones hijo recursivamente
    public function getAllChildren()
    {
        $children = collect();
        
        foreach ($this->parentCompanySites as $child) {
            $children->push($child);
            $children = $children->merge($child->getAllChildren());
        }
        
        return $children;
    }
}