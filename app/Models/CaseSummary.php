<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseSummary extends Model
{
    use HasFactory;

    public $table = "casesummary";

    public $timestamps = false;

    protected $guarded = [];

    public function files()
    {
        return $this->belongsTo(File::class,'id'); 
    }

    public function scopeSearchCaseSummaries($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('name', 'LIKE', "%{$q}%");
    }
}
