<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public $table = "file";

    public $timestamps = false;

    protected $guarded = [];


    public function clients()
    {
        return $this->belongsTo(Client::class, 'clientid');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function locations()
    {
        return $this->belongsTo(Location::class, 'locationid');
    }
    public function cities()
    {
        return $this->belongsTo(City::class, 'cityid');
    }
    public function states()
    {
        return $this->belongsTo(State::class, 'stateid');
    }
    public function sublobs()
    {
        return $this->belongsTo(SubLob::class, 'typeid');
    }
    public function lookups()
    {
        return $this->belongsTo(LookUp::class, 'filestatusid');
    }
    public function lbllookups()
    {
        return $this->belongsTo(LookUp::class, 'reflabel');
    }
    public function relations()
    {
        return $this->belongsTo(LookUp::class, 'relationid');
    }
    public function hubs()
    {
        return $this->belongsTo(Hub::class, 'id');
    }


    public function scopeSearchFiles($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhere('custref', 'LIKE', "%{$q}%")
            ->orWhere('address', 'LIKE', "%{$q}%")
            ->orWhereHas('clients', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('lookups', function ($query) use ($q) {
                $query->where('tag', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('sublobs', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
