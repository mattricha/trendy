<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model {

	protected $fillable = array('articleID', 'weight', 'name', 'url', 'visible');

}
