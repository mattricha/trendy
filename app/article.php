<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model {

    protected $table = 'articles';

	protected $fillable = array('artistID', 'typeID', 'subtypeID', 'templateID', 'title', 'description', 'dimensions', 'size', 'style', 'color', 'stock', 'price', 'sale', 'tags', 'likes', 'dateAdded');

}
