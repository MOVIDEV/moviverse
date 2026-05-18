<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\FnfSubmission;
use App\Models\RewardClaim;

class DashboardController extends Controller
{

    public function index()
    {
        $totalMember = User::where('role', 2)->count(); // role 2 = member fnf
        $totalSubmission = FnfSubmission::count();
        $pendingSubmission = FnfSubmission::where('status', 0)->count();
        $approvedSubmission = FnfSubmission::where('status', 1)->count();

        $pendingClaim = RewardClaim::where('status', 0)->count();

        return view('admin.dashboard', compact(
            'totalMember',
            'totalSubmission',
            'pendingSubmission',
            'approvedSubmission',
            'pendingClaim'
        ));
    }
}
