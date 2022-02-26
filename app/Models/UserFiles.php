<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFiles extends Model
{
    use HasFactory;

    public $table = "userfiles";

    public $timestamps = false;

    protected $guarded = [];

    public function files()
    {
        return $this->belongsTo(File::class, 'fileid');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function scopeSearchUserFiles($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('files', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
