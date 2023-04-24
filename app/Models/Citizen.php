<?php

namespace App\Models;

use App\Http\Resources\CitizenResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Citizen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'firstname', 'lastname', 'username', 'email','login_token',
    ];

    public function setLoginTokenAttribute($username){
        if($username != ''){
            $this->attributes['login_token'] = md5($username);
        }
        else{
            $this->attributes['login_token'] = '';
        }
    }

    public static function CitizenLogin($request){
        $user = Citizen::where([
            ['lastname', $request->lastname],
            ['registration_code', $request->registration_code]
        ])->first();
        if($user){
            if($user->update(['login_token' => $user->username])){
                return new CitizenResource($user);
            }
        }
        return false;
    }

    public static function CitizenLogout($token){
        $user = Citizen::where('login_token', $token)->first();
        if ($user) {
            if ($user->update(['login_token' => ''])) {
                return true;
            }
        }
        return false;
    }

}
