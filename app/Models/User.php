<?php

namespace App\Models;

use App\Models\Scopes\HideDevScope;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'phone',
        'email',
        'password',
        'role',
        'profile_image',
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

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailQueued);
    }

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

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'company_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new HideDevScope);

        static::deleting(function (User $user) {
            if ($user->getRawOriginal('role') === 'dev') {
                throw new \Exception('Developer account cannot be deleted.');
            }
        });
        static::updating(function (User $user) {
            if ($user->getRawOriginal('role') === 'dev') {
                throw new \Exception('Developer account cannot be modified.');
            }
        });
    }

    public function isOnline(): bool
    {
        return Cache::has('user_last_seen_'.$this->id);
    }

    public function lastSeen()
    {
        return Cache::get('last_seen_at_'.$this->id);
    }
}
