<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "organizers";
    public $timestamps = false;
    protected $rememberToken = false;
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
    protected $fillable = [
        'name', 'email', 'password_hash',
    ];

    public function Campaigns()
    {
        return $this->hasMany(Campaign::class, 'campaign_id');
    }
    protected $hidden = [
        'password_hash',
        'email',
        // 'remember_token',
    ];
}
