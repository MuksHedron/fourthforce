<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = "users";


    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }


    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }


    public function usergroups()
    {
        return $this->belongsTo(UserGroup::class, 'id');
    }

    public function userroles()
    {
        return $this->belongsTo(UserRole::class, 'id');
    }

    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendorid');
    }


    public function scopeSearchUsers($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhere('login', 'LIKE', "%{$q}%")
            ->orWhere('email', 'LIKE', "%{$q}%")
            ->orWhere('mobile', 'LIKE', "%{$q}%")
            ->orWhere('code', 'LIKE', "%{$q}%")
            ->orWhereHas('userroles', function ($query) use ($q) {
                $query->where('roles.name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('usergroups', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
