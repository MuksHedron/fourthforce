<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    public $table = "documents";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function scopeSearchDocuments($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
