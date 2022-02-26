<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientGst extends Model
{
    use HasFactory;

    public $table = "clientgst";

    public $timestamps = false;

    protected $guarded = [];

    public function clients()
    {
        return $this->belongsTo(Client::class, 'id');
    }

    public function states()
    {
        return $this->belongsTo(State::class, 'id');
    }

    public function scopeSearchClientGsts($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('gstno', 'LIKE', "%{$q}%")
            ->orWhereHas('clients', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('states', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
