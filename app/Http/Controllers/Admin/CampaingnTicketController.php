<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCampaignTicketRequest;
use App\Models\Campaign;
use App\Models\CampaignTicket;
use Illuminate\Http\Request;

class CampaingnTicketController extends Controller
{
    public function create(Campaign $campaign)
    {
        return view('Admin.Pages.tickets.create', [
            'campaign' => $campaign,
        ]);
    }

    public function store(StoreCampaignTicketRequest $request , Campaign $campaign)
    {
        CampaignTicket::handleStoreCreateTicket($request, $campaign->id);
        return redirect()->route('admin.campaigns.show', $campaign->id)->with('success', 'Ticket successfully created');
    }
}
