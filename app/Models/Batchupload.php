<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batchupload extends Model
{
    use HasFactory;
	public $table = "batch_upload";

    public $timestamps = false;

    protected $guarded = [];
	
	public function fileupload()
	{
		$this->belongsToMany(Fileupload::class,'batch_id');
	}
}
