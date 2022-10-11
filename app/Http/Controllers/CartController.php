<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
<<<<<<< HEAD

    public function __construct() { 
        $this->middleware('auth');
    }

=======
>>>>>>> d158f063be1a86df1598f0d8041de3cb23b5daf7
    public function viewCart() {
        $cart_items = Session::get('cart_items');
         return view('cart/index', compact('cart_items'));
    }
        
    public function addToCart($id) {
        $product = Product::find($id);
        
        $cart_items = Session::get('cart_items');
            if(is_null($cart_items)) {
                $cart_items = array();
        }
        
        $qty = 0;
        if(array_key_exists($product->id, $cart_items)) {
            $qty = $cart_items[$product->id]['qty'];
        }
        
        $cart_items[$product['id']] = array( 
            'id' => $product->id,
            'code' => $product->code,
            'name' => $product->name,
            'price' => $product->price,
            'image_url' => $product->image_url,
            'qty' => $qty + 1,
        );
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }

    public function deleteCart($id) {
        $cart_items = Session::get('cart_items');
        unset($cart_items[$id]);
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }

    public function updateCart($id, $qty) {
        $cart_items = Session::get('cart_items');
        $cart_items[$id]['qty'] = $qty;
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }
}
