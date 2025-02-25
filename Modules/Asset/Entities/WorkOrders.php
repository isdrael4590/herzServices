<?php

namespace Modules\Work_orders\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Work_orders extends Model
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    protected $with = ['media'];


    public function Work_orders() {
        return $this->hasMany(Work_orders::class, 'Work_orders_id', 'id');
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('Work_orders')
            ->useFallbackUrl('/Work_orders/fallback_insitute_image.png');
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
