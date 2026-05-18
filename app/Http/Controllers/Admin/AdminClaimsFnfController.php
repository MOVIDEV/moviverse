<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\FnfSubmission;
use App\Models\RewardClaim;

use Illuminate\Http\Request;



class AdminClaimsFnfController extends Controller
{

    // public function index()
    // {
    //     $claims = RewardClaim::orderBy('created_at', 'desc')->latest()->paginate(3)->withQueryString();

    //     return view('admin.fnf.claims.claimsfnf', compact('claims'));
    // }


    public function index(Request $request)
    {
        $claims = RewardClaim::with('user')

            ->when($request->search, function ($q) use ($request) {

                $search = $request->search;

                $q->where('claim_code', 'like', "%$search%")
                    ->orWhereHas('user', function ($u) use ($search) {

                        $u->where('name', 'like', "%$search%")
                            ->orWhere('alamat', 'like', "%$search%")
                            ->orWhere('no_wa', 'like', "%$search%");
                    });
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();


        // kalau AJAX
        if ($request->ajax()) {
            return view('admin.fnf.partials.table-claimsfnf', compact('claims'))->render();
        }

        return view('admin.fnf.claims.claimsfnf', compact('claims'));
    }

    public function approved($id)
    {
        $claim = RewardClaim::findOrFail($id);

        // $claim->update(['status' => 1]);
        $claim->status = 1;
        $claim->save();



        return redirect()->back()->with('success', 'Claim berhasil di approve!');
    }


    // public function index()
    // {
    //     $totalMember = User::where('role', 2)->count(); // role 2 = member fnf
    //     $totalSubmission = FnfSubmission::count();
    //     $pendingSubmission = FnfSubmission::where('status', 0)->count();
    //     $approvedSubmission = FnfSubmission::where('status', 1)->count();

    //     return view('admin.dashboard', compact(
    //         'totalMember',
    //         'totalSubmission',
    //         'pendingSubmission',
    //         'approvedSubmission'
    //     ));
    // }


}
