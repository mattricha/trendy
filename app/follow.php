<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class follow extends Model {

    protected $table = 'follows';

    protected $fillable = array('artistID', 'userID');

}
