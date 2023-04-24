<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSessionRequest;
use App\Http\Requests\Admin\UpdateSessionRequest;
use App\Models\Campaign;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function create(Campaign $campaign)
    {
        return view('Admin.Pages.sessions.create', [
            'campaign' => $campaign,
        ]);
    }

    public function store(StoreSessionRequest $request, Campaign $campaign)
    {
        if (!Session::HandleStoreSession($request)) {
            return back()->withInput();
        };
        return redirect()->route('admin.campaigns.show', $campaign->id)->with('success', 'Session successfully created');
    }

    public function edit(Campaign $campaign, Session $session)
    {
        return view('Admin.Pages.sessions.edit', [
            'campaign' => $campaign,
            'session' => $session,
        ]);
    }

    public function update(UpdateSessionRequest $request, Campaign $campaign, Session $session)
    {
        if (!Session::HandleUpdateSession($request, $session)) {
            return back()->withInput();
        };
        return redirect()->route('admin.campaigns.show', $campaign->id)->with('success', 'Session successfully updated');
    }
}
