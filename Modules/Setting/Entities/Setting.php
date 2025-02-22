<?php

namespace Modules\Setting\Entities;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    public $timestamps = false;
    protected $with = ['media'];
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('settings')
            ->useFallbackUrl('/settings/fallback_setting_image.png');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(50)
            ->height(50);
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d M, Y');
    }

}
