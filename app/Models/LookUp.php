<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookUp extends Model
{
    use HasFactory;

    public $table = "lookup";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }


    public function scopeSearchLookUps($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('tag', 'LIKE', "%{$q}%")
            ->orWhere('value', 'LIKE', "%{$q}%");
    }
}
