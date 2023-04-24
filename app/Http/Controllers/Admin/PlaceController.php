<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePlaceRequest;
use App\Models\Campaign;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function create(Campaign $campaign)
    {
        return view('Admin.Pages.places.create', [
            'campaign' => $campaign,
        ]);
    }

    public function store(StorePlaceRequest $request, Campaign $campaign)
    {
        $validated = $request->validated();
        $validated['area_id'] = $request->channel;
        Place::create($validated);
        return redirect()->route('admin.campaigns.show', $campaign->id)->with('success', 'Place successfully created');
    }
}
