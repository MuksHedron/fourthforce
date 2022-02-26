<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubLoc extends Model
{
    use HasFactory;

    public $table = "hubloc";

    public $timestamps = false;

    protected $guarded = [];

    public function hubs()
    {
        return $this->belongsTo(Hub::class, 'id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function scopeSearchHubLocs($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('hubs', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('locations', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
