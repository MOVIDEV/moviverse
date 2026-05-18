<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FnfSubmission;
use App\Models\User;

use Illuminate\Http\Request;

class AdminFnfController extends Controller
{
    // public function index()
    // {
    //     $submissions = FnfSubmission::with('user')->latest()->get();

    //     return view('admin.fnf.index', compact('submissions'));

    // }

    // public function index()
    // {
    //     $submissions = FnfSubmission::with(['user', 'files'])
    //         ->latest()
    //         ->paginate(10);


    //     return view('admin.fnf.index', compact('submissions'));
    // }

    public function index(Request $request)
    {
        $query = FnfSubmission::with('user');

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('no_wa', 'like', '%' . $request->search . '%');
            });
        }

        $submissions = FnfSubmission::with(['user', 'files'])
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('user', function ($u) use ($request) {
                    $u->where('name', 'like', '%' . $request->search . '%');
                });
            })->latest()->paginate(10)->withQueryString();

        // ⬇️ kalau AJAX, balikin partial
        if ($request->ajax()) {
            return view('admin.fnf.partials.table', compact('submissions'))->render();
        }

        return view('admin.fnf.index', compact('submissions'));
    }


    // public function datafnf()
    // {
    //     $datafnf = User::where('role', 2)->latest()->paginate(10);
    //     // $nofnf = User::paginate(10);

    //     return view('admin.fnf.datafnf', compact('datafnf'));
    // }

    public function datafnf(Request $request)
    {
        // $datafnf = User::where('role', 2)->latest()->paginate(10);
        // // $nofnf = User::paginate(10);

        $query = User::where('role', 2);


        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('no_wa', 'like', '%' . $request->search . '%');
            });
        }

        $datafnf = User::where('role', 2)
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($u) use ($request) {
                    $u->where('name', 'like', '%' . $request->search . '%');
                });
            })->latest()->paginate(10)->withQueryString();

        // ⬇️ kalau AJAX, balikin partial
        if ($request->ajax()) {
            return view('admin.fnf.partials.table-datafnf', compact('datafnf'))->render();
        }

        return view('admin.fnf.datafnf', compact('datafnf'));
    }



    // public function approve($id)
    // {
    //     $submission = FnfSubmission::with('user')->findOrFail($id);

    //     // update status submission
    //     $submission->status = 1;

    //     // naikkan tier submission
    //     $submission->tier = $submission->tier + 1;
    //     $submission->save();

    //     // naikkan tier user
    //     $user = $submission->user;
    //     $user->tier = $user->tier + 1;
    //     $user->save();

    //     return back()->with('success', 'Submission approved & tier updated');
    // }

    public function approve($id)
    {
        $submission = FnfSubmission::findOrFail($id);

        $submission->update(['status' => 1]); // approved

        $user = $submission->user;

        // 🛑 STOP kalau sudah tier 3 (max tier)
        if ($user->tier >= 3) {
            return back()->with('success', 'Submission approved (MAX TIER tercapai)');
        }

        // naikkan tier user
        $user->increment('tier');

        // bikin submission baru untuk tier baru
        FnfSubmission::firstOrCreate([
            'user_id' => $user->id,
            'tier' => $user->tier,
        ], [
            'status' => 0
        ]);

        return back()->with('success', 'Submission approved & tier naik');
    }

    public function nextStep($id)
    {
        $submission = FnfSubmission::findOrFail($id);

        if ($submission->status != 0) {
            return back()->with('error', 'Submission sudah selesai');
        }

        if ($submission->current_step >= 2) {
            return back()->with('info', 'Step sudah terbuka');
        }

        $submission->current_step = 2;
        $submission->save();

        return back()->with('success', 'Step 2 berhasil dibuka');
    }


    public function reject($id)
    {
        FnfSubmission::where('id', $id)->update([
            'status' => 2 // rejected
        ]);

        return back()->with('error', 'FNF rejected');
    }
}
