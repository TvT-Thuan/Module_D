<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'citizen_id',
        'ticket_id',
        'registration_time',
    ];

    public function Ticket()
    {
        return $this->belongsTo(CampaignTicket::class, 'ticket_id');
    }

    public function Sessions()
    {
        return $this->belongsToMany(Session::class, 'session_registrations');
    }

    public function getListSessionRegistrationAttribute()
    {
        $list = [];
        foreach ($this->Sessions as $session) {
            $list[] = $session->id;
        }
        return $list;
    }

    public static function handleStoreRegistration($ticket, $session_ids, $citizen_id)
    {
        $available = $ticket->special_validity === null ? true : (strpos($ticket->format_specialvalidity, 'tickets') ? $ticket->available_ticket : $ticket->available_date);
        if ($available) {
            $registration = Registration::create([
                'citizen_id' => $citizen_id,
                'ticket_id' => $ticket->id,
                'registration_time' => now()->format('Y-m-d H:i:s'),
            ]);
            if ($session_ids != null) {
                $list_value_session = [];
                foreach ($session_ids as $key => $session_id) {
                    $list_value_session[$key]['registration_id'] = $registration->id;
                    $list_value_session[$key]['session_id'] = $session_id;
                }
                SessionRegistration::insert($list_value_session);
            }
            return true;
        }
        return false;
    }
}
