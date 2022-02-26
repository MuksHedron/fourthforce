<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    use HasFactory;

    public $table = "taskuser";

    public $timestamps = false;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'userid');
    }
	public function tasks()
    {
        return $this->belongsTo(Task::class, 'taskid');
    }

    public function taskroles()
    {
        return $this->belongsTo(TaskRole::class, 'taskroleid');
    }

    public function scopeSearchTaskUsers($query, $q)
    {
        if ($q == null) return $query;

        return $query
            ->whereHas('tasks', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('users', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }
}
