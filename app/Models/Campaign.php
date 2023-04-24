<?php

namespace App\Models;

use Dotenv\Parser\Value;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Campaign extends Model
{
    use HasFactory;
    public $dates = ['date'];
    public $timestamps = false;
    protected $fillable = [
        'organizer_id', 'name', 'slug', 'date',
    ];

    public function getFormatDateAttribute()
    {
        return $this->date->format('Y-m-d');
    }

    public function Registers()
    {
        return $this->hasManyThrough(Registration::class, CampaignTicket::class, 'campaign_id', 'ticket_id');
    }

    public function getNumberRegisterAttribute()
    {
        return $this->Registers->count();
    }

    public function Tickets()
    {
        return $this->hasMany(CampaignTicket::class, 'campaign_id');
    }

    public function Areas()
    {
        return $this->hasMany(Area::class, 'campaign_id');
    }

    public function Places()
    {
        return $this->hasManyThrough(Place::class, Area::class, 'campaign_id', 'area_id');
    }

    public function Sessions()
    {
        $sessions = [];
        foreach ($this->Areas as $area) {
            foreach ($area->Sessions as $session) {
                $sessions[] = $session;
            }
        }
        return $sessions;
    }

    //get data use chartjs
    public function titleSessions()
    {
        $titleSessions = [];
        foreach ($this->Sessions() as $session) {
            $titleSessions[] = $session->title;
        }
        return $titleSessions;
    }

    public function capacitySessions()
    {
        $capacitySessions = [];
        foreach ($this->Sessions() as $session) {
            $capacitySessions[] = $session->Places->capacity;
        }
        return $capacitySessions;
    }

    public function totalRegistrationSessions()
    {
        $totalRegistrationSessions = [];
        foreach ($this->Sessions() as $session) {
            $totalRegistrationSessions[] = $session->SessionRegistration->count();
        }
        return $totalRegistrationSessions;
    }

    public function colorChartReportSessions()
    {
        $colorChartReportSessions = [];
        foreach ($this->Sessions() as $session) {
            if ($session->SessionRegistration->count() > $session->Places->capacity) {
                $colorChartReportSessions[] = '#f1a8a1';
            }
            $colorChartReportSessions[] = '#a1cbf5';
        }
        return $colorChartReportSessions;
    }
    // Api
    public function Users()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public static function checkSlugCampaignAndUser($organizer_slug, $campaign_slug)
    {
        $user = User::where('slug', $organizer_slug)->first();
        if (!$user) {
            return ['message' => 'Organizer not found'];
            // return response()->json(['message' => 'Organizer not found'], 404);
        }
        $campaign = Campaign::where([['slug', $campaign_slug], ['organizer_id', $user->id]])->first();
        if (!$campaign) {
            return ['message' => 'Campaign not found'];
            // return response()->json(['message' => 'Campaign not found'], 404);
        }
        return $campaign;
    }

    public static function checkIssetTicketAndSessions($campaign_id, $ticket_id, $session_ids)
    {
        $ticket = CampaignTicket::where([['id', $ticket_id], ['campaign_id', $campaign_id]])->first();
        if (!$ticket) {
            return ['message' => 'Ticket not isset Campaign'];
        }
        if ($session_ids != null) {
            $get_session_ids = [];
            $list_session = Campaign::find($campaign_id)->Sessions();
            foreach ($list_session as $session) {
                $get_session_ids[] = $session->id;
            }
            foreach ($session_ids as $session_id) {
                if (!in_array($session_id, $get_session_ids)) {
                    return ['message' => 'Session ' . $session_id . ' not isset Campaign'];
                }
            }
        }
        return $ticket;
    }

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];
}
