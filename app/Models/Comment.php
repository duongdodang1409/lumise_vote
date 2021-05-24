<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'comment_id', 'post_id', 'user_id', 'comment_status', 'comment_content', 'comment_images', 'comment_create'
    ];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';
}
