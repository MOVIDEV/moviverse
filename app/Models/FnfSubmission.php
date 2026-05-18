<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FnfSubmission extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;

    protected $fillable = [
        'user_id',
        'referal1',
        'referal2',
        'referal3',
        'referal4',
        'referal5',
        'referal6',
        'referal7',
        'tier',
        'status',
        'current_step'
    ];

    public function files()
    {
        // return $this->hasMany(FnfSubmissionFile::class);
        return $this->hasMany(FnfSubmissionFile::class, 'submission_id');
    }

    public function maxFiles()
    {
        return match ($this->tier) {
            1 => 6,
            2 => 10,
            3 => 14,
            default => 0,
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

    public function rewardClaims()
    {
        return $this->hasMany(RewardClaim::class, 'submission_id');
    }
}
