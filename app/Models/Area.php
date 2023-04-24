<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'campaign_id' ,'name',
    ];

    public function Places(){
        return $this->hasMany(Place::class, 'area_id');
    }

    public function Campaign(){
        return $this->belongsTo(Campaign::class, 'area_id');
    }

    public function Sessions(){
        return $this->hasManyThrough(Session::class ,Place::class, 'area_id', 'place_id')->orderBy('start');
    }

    public function getSessionAndPlaceAttribute()
    {
        return $this->Sessions()->count() . " sessions, " . $this->Places()->count() . " places";
    }
}
