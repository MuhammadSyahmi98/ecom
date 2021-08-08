<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
   public function addToCart(Product $product){

      if(session()->has('cart')){
         $cart = new Cart(session()->get('cart'));
      }else{
         $cart = new Cart();
      }

      $cart->add($product);


      session()->put('cart', $cart);

      return redirect()->back()->with('message', 'Product Added Into Cart!');

   }


   public function showCart(){
      if(session()->has('cart')){
         $cart = new Cart(session()->get('cart'));
      }else{
         $cart = null;
      }

      return view('cart', ['cart'=>$cart]);
   }

   public function updateCart(Request $request, Product $product){
      $request->validate([
         'quantity'=>'required|numeric|min:1'
      ]);

      $cart = new Cart(session()->get('cart'));
      $cart->updateQuantity($product->id, $request->quantity);
      session()->put('cart', $cart);

      return redirect()->back()->with('message', 'Success update cart');
   }
   
   public function removeCart(Product $product){
      $cart = new Cart(session()->get('cart'));
      $cart->remove($product->id);
      if($cart->totalQuantity <= 0){
         session()->forget('cart');
      } else {
         session()->put('cart', $cart);
      }

      return redirect()->back()->with('message', 'Success remove cart');
   }


   public function checkout($amount){
      if(session()->has('cart')){
         $cart = new Cart(session()->get('cart'));
      }else{
         $cart = null;
      }

   
      return view('checkout', ['amount'=>$amount, 'cart'=>$cart]);
   }

   public function showOrders(){
      $orders = auth()->user()->orders;
       $carts = $orders->transform(function($cart, $key){
         return unserialize($cart->cart);
      });
      
      return view('order', ['carts'=>$carts]);
   }

   public function userOrders(){
      $orders = Order::latest()->get();
      return view('admin.order.index', ['orders'=>$orders]);
   }

   public function viewUserOrder($userid,$orderid){
      $user = User::find($userid);
        $orders = $user->orders->where('id',$orderid);
        $carts =$orders->transform(function($cart,$key){
            return unserialize($cart->cart);

        });
      
      return view('admin.order.show', ['carts'=>$carts]);
   }
}
