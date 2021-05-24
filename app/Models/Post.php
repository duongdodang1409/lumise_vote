<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'tag_id', 'user_create', 'post_title', 'post_content', 'post_image', 'post_vote_ids', 'post_vote_count', 'post_status', 'post_create','post_status_int'
    ];
    protected $primaryKey = 'post_id';
    protected $table = 'tbl_post';
}
