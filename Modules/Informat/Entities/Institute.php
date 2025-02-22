<?php

namespace Modules\Informat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
 
class Institute extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    protected $with = ['media'];


    public function institute() {
        return $this->hasMany(Institute::class, 'institute_id', 'id');
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('institutes')
            ->useFallbackUrl('/institutes/fallback_insitute_image.png');
    }

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')
            ->width(50)
            ->height(50);
    }
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d M, Y');
    }
}
