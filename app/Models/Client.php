<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public $table = "client";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'categoryid');
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'cityid');
    }

    public function scopeSearchClients($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhere('shortname', 'LIKE', "%{$q}%")
            ->orWhere('contactname', 'LIKE', "%{$q}%")
            ->orWhere('tele1', 'LIKE', "%{$q}%")
            ->orWhere('tele2', 'LIKE', "%{$q}%")
            ->orWhere('email1', 'LIKE', "%{$q}%")
            ->orWhere('email2', 'LIKE', "%{$q}%")
            ->orWhereHas('cities', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
