<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role == 'ADMIN';
    }
    /**
     * Get all of the incomes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    /**
     * Get all of the expendirures for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expendirures(): HasMany
    {
        return $this->hasMany(Expenditure::class);
    }
}
