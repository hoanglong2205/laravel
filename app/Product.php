<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	public $fillalbe = ['title'];

	public function searchableAs()
	{
		return 'products_index';
	}

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function users(){
    	return $this->belongsToMany('App\User');
    }

    public function orders(){
    	return $this->belongsToMany('App\Order')->withPivot('quantity');
    }
}
