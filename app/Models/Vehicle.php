<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'vehicle_type',
        'size_type',
        'fuel_type',
        'license_plate',
        'brand_id',
        'description',
        'model',
        'year',
        'color',
        'transmission',
        'image',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function parkings(): HasMany
    {
        return $this->hasMany(Parking::class);
    }

    public function activeParkings()
    {
        return $this->parkings()->active();
    }

    public function hasActiveParkings(): bool
    {
        return $this->activeParkings()->exists();
    }
}
