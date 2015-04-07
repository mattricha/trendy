<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class saleshistory extends Model {

    protected $table = 'saleshistory';

    protected $fillable = array('articleID', 'userID', 'artistID', 'typeID', 'subtypeID', 'templateID', 'title', 'dimensions', 'size', 'style', 'color', 'quantity', 'price', 'discount', 'originalPrice', 'dateSold');

}
