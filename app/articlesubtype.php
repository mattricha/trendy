<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class articlesubtype extends Model {

    protected $table = 'articlesubtypes';

	protected $fillable = array('typeID', 'name');

}
