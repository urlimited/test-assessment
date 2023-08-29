<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['destination', 'slug', 'views'];

    protected $appends = ['full_url'];

    public function getFullUrlAttribute(): string
    {
        return config('url_shortening.base_url') . '/' . $this->getAttribute('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOld(Builder $query): Builder
    {
        $threshold = now()->subDays(config('url_shortening.old_threshold_in_days'));

        return $query->where('created_at', '<=', $threshold);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeNotVisited(Builder $query): Builder
    {
        $threshold = config('url_shortening.visits_threshold');

        return $query->where('views', '<=', $threshold);
    }
}
