<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title','slug', 'price', 'image'];

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
    
}
