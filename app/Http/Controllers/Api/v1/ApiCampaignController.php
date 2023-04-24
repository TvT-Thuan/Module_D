<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use App\Models\User;

class ApiCampaignController extends Controller
{
    public function index()
    {
        return response()->json(['campaigns' => CampaignResource::collection(Campaign::get())]);
    }

    public function show($organizer_slug, $campaign_slug)
    {   
        $data = Campaign::checkSlugCampaignAndUser($organizer_slug, $campaign_slug);
        if(isset($data['message'])){
            return response()->json(['message' => $data['message']], 404);
        }
        return response()->json(new CampaignResource($data));
    }
}
