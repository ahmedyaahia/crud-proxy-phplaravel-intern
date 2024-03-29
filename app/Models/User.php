<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'type' => 'integer', // Ensure 'type' is cast to integer
    ];

    /**
     * Get the user type.
     *
     * @param  mixed  $value
     * @return string
     */
    public function getTypeAttribute($value)
    {
        // Ensure $value is within the valid range
        if ($value === 0) {
            return "user";
        } elseif ($value === 1) {
            return "admin";
        } else {
            return "unknown"; 
        }
    }
    
}
