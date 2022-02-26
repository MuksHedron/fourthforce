<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    use HasFactory;

    public $table = "userclient";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function clients()
    {
        return $this->belongsTo(Client::class, 'clientid');
    }

    public function scopeSearchUserClients($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('clients', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
