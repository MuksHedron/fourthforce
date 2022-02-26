<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    public $table = "usersrole";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'usersid');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'roleid');
    }

    public function scopeSearchUserRoles($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('roles', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
