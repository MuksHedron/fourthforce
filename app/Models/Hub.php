<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    use HasFactory;

    public $table = "hub";

    public $timestamps = false;

    protected $guarded = [];


    public function cities()
    {
        return $this->belongsTo(City::class, 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'categoryid');
    }

    public function scopeSearchHubs($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhereHas('cities', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('categories', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
