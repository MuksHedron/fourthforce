<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseTracker extends Model
{
    use HasFactory;

    public $table = "casetracker";

    public $timestamps = false;

    protected $guarded = [];

    public function scopeSearchCaseTrackers($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->orWhere('oldstatus', 'LIKE', "%{$q}%")
            ->orWhere('newstatus', 'LIKE', "%{$q}%")
            ->orWhereHas('files', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
