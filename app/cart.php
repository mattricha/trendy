<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model {

    protected $table = 'carts';

    protected $fillable = array('articleID', 'userID', 'quantity');

}
