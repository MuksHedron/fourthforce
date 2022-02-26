<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseResponse extends Model
{
    use HasFactory;

    public $table = "caseresponse";

    public $timestamps = false;

    protected $guarded = [];

    public function questions()
    {
        return $this->belongsTo(Questions::class, 'questionid');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function files()
    {
        return $this->belongsTo(File::class, 'id');
    }

    public function lookups()
    {
        return $this->belongsTo(LookUp::class, 'response');
    }


    public function scopeSearchCaseResponses($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->where('caseid', 'LIKE', "%{$q}%")
            ->orWhere('questionid', 'LIKE', "%{$q}%")
            ->orWhereHas('questions', function ($query) use ($q) {
                $query->where('question', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('files', function ($query) use ($q) {
                $query->where('policyno', 'LIKE', "%{$q}%");
            });
    }
}
