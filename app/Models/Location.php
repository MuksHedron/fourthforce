<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public $table = "location";

    public $timestamps = false;

    protected $guarded = [];

    public function cities()
    {
        return $this->belongsTo(City::class, 'cityid');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }


    public function scopeSearchLocations($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhereHas('cities', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
