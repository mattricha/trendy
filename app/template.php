<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class template extends Model {

    protected $table = 'templates';

    protected $fillable = array('artistID', 'name', 'description', 'url', 'url100x100', 'url200x200', 'url500W');

}
