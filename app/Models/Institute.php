<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Institute extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guard='institute';
    protected $fillable = [
        'name',
        'email',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function programmes(): HasMany
    {
        return $this->hasMany(Programme::class);
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function practicals(): HasMany
    {
        return $this->hasMany(Practical::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
    public function skillcategories(): HasMany
    {
        return $this->hasMany(Skillcategory::class);
    }

}
