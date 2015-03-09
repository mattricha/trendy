<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model {

	protected $fillable = array('title', 'artist', 'origin', 'description', 'dimensions', 'color', 'stock', 'price', 'sale', 'tags');

}
