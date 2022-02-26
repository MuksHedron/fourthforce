<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    public $table = "questions";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class,'id'); 
    }

    public function sublobs()
    {
        return $this->belongsTo(SubLob::class,'sublobid'); 
    }
 

    public function scopeSearchQuestions($query, $q)
    {
        if($q==null) return $query;

        return $query
            ->where('questiongroup', 'LIKE', "%{$q}%") 
            ->orWhere('question', 'LIKE', "%{$q}%"); 
    }
}
