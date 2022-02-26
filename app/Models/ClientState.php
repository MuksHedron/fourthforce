<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientState extends Model
{
    use HasFactory;

    public $table = "clientstate";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function clients()
    {
        return $this->belongsTo(Client::class, 'clientid');
    }

    public function states()
    {
        return $this->belongsTo(State::class, 'stateid');
    }

    public function scopeSearchClientStates($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('clients', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
