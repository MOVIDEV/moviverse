<?php

namespace App\Http\Controllers\FNF;

use App\Http\Controllers\Controller;
use App\Models\FnfSubmission;
use App\Models\RewardClaim;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FnfRewardClaimController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        // $submission = FnfSubmission::where('user_id', $user->id)->latest()->first();

        $submissions = FnfSubmission::where('user_id', $user->id)
            ->get()
            ->keyBy('tier');



        $claims = RewardClaim::where('user_id', $user->id)
            ->get()
            ->keyBy(fn($c) => $c->tier . '-' . $c->step);

        return view('fnf.rewards.index', compact('submissions', 'claims'));
    }

    public function claim(Request $request, $submissionId)
    {
        $user = Auth::user();

        // 🔥 update alamat user dulu
        $user->update([
            'alamat' => $request->alamat,
            'no_wa' => $request->no_wa
        ]);

        $submission = FnfSubmission::findOrFail($submissionId);

        $step = (int) $request->step;
        $tier = (int) $request->tier;


        // 🔐 VALIDASI LOGIC STEP
        if ($step === 1) {
            if ($submission->current_step < 2) {
                return back()->with('error', 'Step 1 belum terbuka');
            }
        }

        if ($step === 2) {
            if (!($submission->current_step >= 2 && $submission->status == 1)) {
                return back()->with('error', 'Step 2 belum di-approve');
            }
        }

        // ⛔ anti double claim (PER TIER + STEP)
        $alreadyClaimed = RewardClaim::where([
            'submission_id' => $submission->id,
            'tier' => $tier,
            'step' => $step,
        ])->exists();

        if ($alreadyClaimed) {
            return back()->with('error', 'Reward sudah diklaim');
        }

        RewardClaim::create([
            'submission_id' => $submission->id,
            'user_id' => $user->id,
            'tier' => $tier,
            'step' => $step,
            'claim_code' => 'MOVI-' . $user->id . "-T{$tier}-S{$step}",
            'status' => 0,
        ]);

        return back()->with('success', "Reward Tier {$tier} Step {$step} berhasil diklaim");
    }
}
