<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public $table = "vendor";

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

    public function scopeSearchVendors($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhere('shortname', 'LIKE', "%{$q}%")
            ->orWhere('contact', 'LIKE', "%{$q}%")
            ->orWhere('email', 'LIKE', "%{$q}%")
            ->orWhere('mobile', 'LIKE', "%{$q}%")
            ->orWhere('address', 'LIKE', "%{$q}%")
            ->orWhere('pincode', 'LIKE', "%{$q}%")
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
