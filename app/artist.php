<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class artist extends Model {

    protected $table = 'artists';

    protected $fillable = array('name', 'email', 'company', 'description', 'urlProfileImage', 'urlHeader', 'urlPortfolio', 'dateJoined');

}
