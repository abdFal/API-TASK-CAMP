<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'price', 'image'];

    /**
     * Get all of the comments for the Camp
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function camp_benefits(): HasMany
    {
        return $this->hasMany(CampBenefit::class, 'camp_id', 'id');
    }

    /**
     * Get all of the comments for the Camp
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enrolls(): HasMany
    {
        return $this->hasMany(Enroll::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($camp) {
            $title = str_replace('?', '', $camp->title);
            $slug = preg_replace('/\s+/', '-', $title);
            $camp->slug = $slug;
        });
        static::updating(function ($camp) {
            $title = str_replace('?', '', $camp->title);
            $slug = preg_replace('/\s+/', '-', $title);
            $camp->slug = $slug;
        });
    }

    
}
