<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;
use App\Models\Event;


class User extends AuthenticatableUser implements Authenticatable
{
    
    protected $primaryKey = 'userID';
    protected $fillable = [
        'username', 'fname', 'lname', 'password', 'email', 'is_officer', 'is_admin', 'org_code', 'image',
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
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'is_officer'=> 'boolean',
        
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'attendees')->withPivot('status')->withTimestamps();
    }

   

 
    
}
