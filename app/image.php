<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model {

    protected $table = 'images';

	protected $fillable = array('articleID', 'weight', 'name', 'url', 'url100x100', 'url200x200', 'url500W', 'visible');

}
