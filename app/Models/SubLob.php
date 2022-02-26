<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLob extends Model
{
    use HasFactory;

    public $table = "sublob";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function lobs()
    {
        return $this->belongsTo(Lob::class, 'lobid');
    }


    public function scopeSearchSubLobs($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('shortname', 'LIKE', "%{$q}%")
            ->orWhere('name', 'LIKE', "%{$q}%")
            ->orWhereHas('lobs', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
