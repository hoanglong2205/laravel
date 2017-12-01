<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
    	if ($oldCart){
    		$this->items =  $oldCart->items;
    		$this->totalQuantity = $oldCart->totalQuantity;
    		$this->totalPrice = $oldCart->totalPrice;
    	}
    }

    //add item to cart
    public function add($item, $id)
    {
    	//create new array for item in cart
    	$storedItem = ['quantity' => 0, 'price' => $item->price, 'item' => $item, 'image' => $item->image, 'description' => $item->description];
    	//check if we already have this item on cart
    	if ($this->items){
    		if (array_key_exists($id, $this->items)){
    			$storedItem = $this->items[$id];
    		}
    	}
    	$storedItem['quantity']++;
    	$storedItem['price'] = $item->price * $storedItem['quantity'];
    	$this->items[$id] = $storedItem;
    	$this->totalQuantity++;
    	$this->totalPrice += $item->price;
    }
    
    public function changeQuantity($item, $num)
    {
		$changeItem = $this->items[$item->id];
		if ($changeItem['quantity'] >= 1){
			$changeItem['quantity'] = $changeItem['quantity'] + $num;
			if ($changeItem['quantity'] == 0){
				return $this->remove($item);
			}
			$changeItem['price'] = $item->price * $changeItem['quantity'];
			$this->items[$item->id] = $changeItem;
	    	$this->totalQuantity += $num;
	    	$this->totalPrice += $item->price * $num;	
		}
	}

	public function remove($item)
	{
		$removeItem = $this->items[$item->id];
		$this->totalQuantity -= $removeItem['quantity'];
		$this->totalPrice -= $item->price * $removeItem['quantity'];
		unset($this->items[$item->id]);
	}
}
