<?php

namespace Modules\Machine\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function machines() {
        return $this->hasMany(Machine::class, 'category_id', 'id');
    }
}
