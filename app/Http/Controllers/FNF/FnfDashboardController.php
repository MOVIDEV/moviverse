<?php

namespace App\Http\Controllers\FNF;

use App\Http\Controllers\Controller;
use App\Models\FnfSubmission;
use Illuminate\Http\Request;


class FnfDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ambil submission aktif user (tier sekarang)
        $submission = FnfSubmission::where('user_id', $user->id)
            ->where('tier', $user->tier)
            ->latest()
            ->first();

        // rule upload per tier
        $rule = $this->submissionRule($user->tier);

        return view('fnf.dashboard', compact('submission', 'rule'));
    }

    /**
     * Rule upload per tier
     */
    private function submissionRule($tier)
    {
        return match ($tier) {
            1 => [
                'max_files' => 6,
            ],
            2 => [
                'max_files' => 10,
            ],
            3 => [
                'max_files' => 14,
            ],
            default => [
                'max_files' => 0,
            ],
        };
    }

    // public function getTierBadgeAttribute()
    // {
    //     return match ($this->tier) {
    //         1 => ['label' => 'Silver', 'class' => 'bg-sky-700 text-black'],
    //         2 => ['label' => 'Gold', 'class' => 'bg-yellow-400 text-black'],
    //         3 => ['label' => 'Platinum', 'class' => 'bg-indigo-500 text-black'],

    //         default => ['label' => '-', 'class' => 'bg-gray-200'],
    //     };
    // }

    public function getTierBadgeAttribute()
    {
        switch ($this->tier) {
            case 1:
                return [
                    'label' => 'Silver',
                    'class' => 'bg-blue-100 text-blue-700'
                ];
            case 2:
                return [
                    'label' => 'Gold',
                    'class' => 'bg-green-100 text-green-700'
                ];
            default:
                return [
                    'label' => 'Platinum',
                    'class' => 'bg-gray-100 text-gray-500'
                ];
        }
    }
}
