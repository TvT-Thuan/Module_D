<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRegistrationRequest;
use App\Http\Resources\RegistrationResource;
use App\Models\Campaign;
use App\Models\CampaignTicket;
use App\Models\Citizen;
use App\Models\Registration;
use Illuminate\Http\Request;

class ApiRegistrationController extends Controller
{
    public function create(Request $request, StoreRegistrationRequest $store_request, $organizer_slug, $campaign_slug)
    {
        $citizen = Citizen::where("login_token", $request->token)->first();
        if (!$citizen) {
            return response()->json(['message', 'User not logged in'], 401);
        }
        $campaign = Campaign::checkSlugCampaignAndUser($organizer_slug, $campaign_slug);
        if (isset($campaign['message'])) {
            return response()->json(['message' => $campaign['message']], 404);
        }
        $ticket_id = $store_request->ticket_id;
        $session_ids = $store_request->session_ids;
        $ticket = Campaign::checkIssetTicketAndSessions($campaign->id, $ticket_id, $session_ids);
        if (isset($ticket['message'])) {
            return response()->json(['message' => $ticket['message']], 404);
        }
        if (Registration::where([['ticket_id', $ticket_id], ['citizen_id', $citizen->id]])->first()) {
            return response()->json(['message' => 'User already registered'], 401);
        }
        if (Registration::handleStoreRegistration($ticket, $session_ids, $citizen->id)) {
            return response()->json(['message' => 'Registration successful'], 200);
        }
        return response()->json(['message' => 'Ticket is no longer available'], 401);
    }

    public function show(Request $request)
    {
        $citizen = Citizen::where("login_token", $request->token)->first();
        if (!$citizen) {
            return response()->json(['message', 'User not logged in'], 401);
        }
        $registration = Registration::where('citizen_id', $citizen->id)->first();
        if ($registration) {
            return response()->json(['registrations' => RegistrationResource::collection(Registration::where('citizen_id', $citizen->id)->get())]);
        }
        return response()->json(['message' => 'Citizen not registered'], 401);
    }
}
