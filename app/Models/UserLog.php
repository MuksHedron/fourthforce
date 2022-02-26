<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    public $table = "userlog";

    public $timestamps = false;

    protected $guarded = [];


    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }


    public function scopeSearchUserLogs($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
