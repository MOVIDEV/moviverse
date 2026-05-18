<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FnfSubmissionFile extends Model
{
    protected $fillable = ['submission_id', 'file_path'];

    public function submission()
    {
        // return $this->belongsTo(FnfSubmission::class);
        return $this->belongsTo(FnfSubmission::class, 'submission_id');
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
}
