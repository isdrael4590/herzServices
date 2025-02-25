<?php

namespace Modules\Asset\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Asset extends Model
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    protected $with = ['media'];


    public function asset() {
        return $this->hasMany(Asset::class, 'Asset_id', 'id');
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('assets')
            ->useFallbackUrl('/Assets/fallback_insitute_image.png');
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
