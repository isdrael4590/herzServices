<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder',
        'filename', 
        'original_name'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the full path of the temporary file
     */
    public function getFullPathAttribute()
    {
        return storage_path('app/temp/' . $this->folder . '/' . $this->filename);
    }

    /**
     * Check if the temporary file exists
     */
    public function fileExists()
    {
        return file_exists($this->getFullPathAttribute());
    }
}