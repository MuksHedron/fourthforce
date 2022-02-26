<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoc extends Model
{
    use HasFactory;

    public $table = "userloc";

    public $timestamps = false;

    protected $guarded = [];

    public function locations()
    {
        return $this->belongsTo(Location::class, 'locationid');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'usersid');
    }

    public function scopeSearchUserLocs($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('locations', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
