<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'tag_name', 'tag_url', 'tag_create', 'tag_status'
    ];
    protected $primaryKey = 'tag_id';
    protected $table = 'tbl_tags';
}
