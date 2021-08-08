<?php
namespace App\Models;

class Cart{
    public $items = [];
    public $totalQuantity;
    public $totalPrice;

    public function __construct($cart=null){
        if($cart){
            $this->items = $cart->items;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->totalQuantity;
            
        }else {
            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
        }
    }

    public function add($product){
        $items = [
            'id'=>$product->id,
            'name'=>$product->name,
            'price'=>$product->price,
            'quantity'=>0,
            'image'=>$product->image
        ];

        // check items kalau ada product->id
        if(!array_key_exists($product->id, $this->items)){
            $this->items[$product->id] = $items;
            $this->totalQuantity+=1;
            $this->totalPrice += $product->price;
        } else {
            // kalau product dh ada just tambah ni saja
            $this->totalQuantity+=1;
            $this->totalPrice+=$product->price;
        }

        $this->items[$product->id]['quantity']+=1;
    }

    public function updateQuantity($id, $quantity){
        $this->totalQuantity-=$this->items[$id]['quantity'];
        $this->totalPrice-=$this->items[$id]['price']*$this->items[$id]['quantity'];
        $this->items[$id]['quantity'] = $quantity;
        $this->totalQuantity+=$quantity;
        $this->totalPrice+=$this->items[$id]['price']*$quantity;
    }

    public function remove($id){
        if(array_key_exists($id, $this->items)){
            $this->totalQuantity-=$this->items[$id]['quantity'];
            $this->totalPrice-=$this->items[$id]['quantity']*$this->items[$id]['price'];
            unset($this->items[$id]);
        }
    }
   

    
}

?>