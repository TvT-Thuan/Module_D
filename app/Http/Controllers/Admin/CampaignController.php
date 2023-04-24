<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCampaignRequest;
use App\Http\Requests\Admin\UpdateCampaignRequest;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    public function index()
    {
        $data = Campaign::where('organizer_id', Auth::user()->id)->get();
        return view('Admin.Pages.campaigns.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('Admin.Pages.campaigns.create');
    }

    public function store(StoreCampaignRequest $request)
    {
        $validated = $request->validated();
        $validated['organizer_id'] = Auth::user()->id;
        $campaign = Campaign::create($validated);
        return redirect()->route('admin.campaigns.show', $campaign->id)->with('success', 'Campaign successfully created');
    }

    public function show(Campaign $campaign)
    {
        return view('Admin.Pages.campaigns.detail', [
            'campaign' => $campaign,
        ]);
    }

    public function edit(Campaign $campaign)
    {
        return view('Admin.Pages.campaigns.edit',  [
            'campaign' => $campaign,
        ]);
    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->validated());
        return redirect()->route('admin.campaigns.show', $campaign->id)->with('success', 'Campaign successfully updated');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route("admin.campaigns.index")->with("success", "Delete Campaign Success");
    }
}
