<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class articletype extends Model {

    protected $table = 'articletypes';

	protected $fillable = array('name');

}
