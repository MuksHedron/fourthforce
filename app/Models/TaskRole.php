<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskRole extends Model
{
    use HasFactory;

    public $table = "taskrole";

    public $timestamps = false;

    protected $guarded = [];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'roleid');
    }
    public function tasks()
    {
        return $this->belongsTo(Task::class, 'taskid');
    }


    public function scopeSearchTaskRoles($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('roles', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('tasks', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
