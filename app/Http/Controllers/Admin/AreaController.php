<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAreaRequest;
use App\Models\Area;
use App\Models\Campaign;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function create(Campaign $campaign)
    {
        return view('Admin.Pages.areas.create', [
            'campaign' => $campaign,
        ]);
    }

    public function store(StoreAreaRequest $request,Campaign $campaign)
    {
        $validated = $request->validated();
        $validated['campaign_id'] = $campaign->id;
        Area::create($validated);
        return redirect()->route('admin.campaigns.show', $campaign->id)->with('success', 'Area successfully created');
    }
}
