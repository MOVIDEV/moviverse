<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardClaim extends Model
{
    protected $fillable = [
        'submission_id',
        'user_id',
        'tier',
        'step',
        'claim_code',
        'status',
    ];

    public function user()
    {
        
        return $this->belongsTo(User::class);
    }

    public function submission()
    {
        return $this->belongsTo(FnfSubmission::class, 'submission_id');
    }
}
