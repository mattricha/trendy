<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model {

    protected $table = 'likes';

    protected $fillable = array('articleID', 'userID');

}
