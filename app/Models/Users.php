<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    public $table = "tbl_users";

    public function getFirst(){
    	$sql = "SELECT * FROM {$this->table} ORDER BY user_id ASC LIMIT 1";
    	return $sql;

    }
}
