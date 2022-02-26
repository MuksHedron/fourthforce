<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentLob extends Model
{
    use HasFactory;

    public $table = "documentlob";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function documents()
    {
        return $this->belongsTo(Documents::class, 'id');
    }

    public function sublobs()
    {
        return $this->belongsTo(SubLob::class, 'id');
    }

    public function scopeSearchDocumentLobs($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('documents', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('sublobs', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
