<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $table = "role";

    public $timestamps = false;

    protected $guarded = [];


    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function scopeSearchRoles($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhere('level', 'LIKE', "%{$q}%")
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
