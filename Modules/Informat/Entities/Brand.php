<?php

namespace Modules\Informat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brand() {
        return $this->hasMany(Informat::class, 'brand_id', 'id');
    }
}
