<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Campaign $campaign){
        return view('Admin.Pages.reports.index',[
            'campaign' => $campaign
        ]);
    }
}
