<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkFlow extends Model
{
    use HasFactory;

    public $table = "workflow";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function scopeSearchWorkFlows($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('wfstate', 'LIKE', "%{$q}%")
            ->orWhere('wforder', 'LIKE', "%{$q}%")
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
