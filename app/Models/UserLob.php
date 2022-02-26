<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLob extends Model
{
    use HasFactory;

    public $table = "userlob";

    public $timestamps = false;

    protected $guarded = [];


    public function sublobs()
    {
        return $this->belongsTo(SubLob::class, 'sublobid');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function scopeSearchUserLobs($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('sublobs', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
