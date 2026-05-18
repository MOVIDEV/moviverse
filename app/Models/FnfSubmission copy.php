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
        'fullname',
        'phone',
        'instagram',
        'ss1',
        'ss2',
        'ss3',
        'ss4',
        'ss5',
        'ss6',
        'tier',
        'status',
    ];
}
