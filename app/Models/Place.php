<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'area_id', 'name', 'capacity',
    ];

    public function Sessions()
    {
        return $this->hasMany(Session::class, 'place_id');
    }

    public function Areas()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function getAreaAndPlaceAttribute()
    {
        return $this->Areas->name . " / " . $this->name;
    }
}
