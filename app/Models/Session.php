<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Session extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected  $dates = ['start', 'end'];
    protected $fillable = [
        'place_id', 'title', 'description', 'vaccinator', 'start', 'end', 'type', 'cost'
    ];
    // view edit
    public function getFormatTimeStartAttribute()
    {
        return $this->start->format('Y-m-d H:i');
    }
    //view edit
    public function getFormatTimeEndAttribute()
    {
        return $this->end->format('Y-m-d H:i');
    }
    //view detail
    public function getFormatTimeAttribute()
    {
        return $this->start->format('H:i') . " - " . $this->end->format('H:i');
    }

    public function SessionRegistration(){
        return $this->hasMany(SessionRegistration::class, 'session_id');
    }

    public function Places()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function getAreaAndPlaceAttribute()
    {
        return $this->Places->Areas->name . " / " . $this->Places->name;
    }
    // sử lý tạo session
    public static function HandleStoreSession($request)
    {
        if (Session::where(
            'place_id',$request->place,
        )->where(self::checkDateIssetDatabase($request))->exists()) {
            session()->flash('error', 'Places already booked during this time');
            return false;
        } else {
            $validated = $request->validated();
            $validated['vaccinator'] = $request->participant;
            $validated['place_id'] = $request->place;
            Session::create($validated);
        };
        return true;
    }
    // sử lý cập nhật session
    public static function HandleUpdateSession($request, $session)
    {
        if (Session::where([
            ['id', '<>', $session->id],
            ['place_id', $request->place],
        ])->where(self::checkDateIssetDatabase($request))->exists()) {
            session()->flash('error', 'Places already booked during this time');
            return false;
        } else {
            $validated = $request->validated();
            $validated['vaccinator'] = $request->participant;
            $validated['place_id'] = $request->place;
            $session->update($validated);
        };
        return true;
    }
    //kiểm tra thời gian người dùng nhập đã tồn tại trong db chưa
    public static function checkDateIssetDatabase($request)
    {
        return function ($q) use ($request) {
            $q->whereBetween(
                'start',
                [$request->start, $request->end]
            )->orWhereBetween(
                'end',
                [$request->start, $request->end]
            )->orWhere([
                ['start', '<=', $request->start],
                ['end', '>=', $request->end]
            ]);
        };
    }
    protected $casts = [
        'cost' => 'double',
    ];
}
