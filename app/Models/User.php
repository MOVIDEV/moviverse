<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        'username_ig',
        'username_tiktok',
        'nik',
        'no_wa',
        'followers_ig',
        'followers_tiktok',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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
        return $this->hasMany(RewardClaim::class);
    }
}
