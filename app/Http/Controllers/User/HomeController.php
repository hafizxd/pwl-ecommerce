<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index() {
        $products = Product::orderBy('created_at', 'desc')->get();

        return view('user.home', compact('products'));
    }

    public function indexCart() {
        $carts = auth()->user()->carts()
                    ->with('product')
                    ->orderBy('created_at', 'desc')
                    ->get();

        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->quantity * $cart->product->price;
        }

        return view('user.cart', compact('carts', 'totalPrice'));
    }

    public function storeCart($productId, Request $request) {
        $existingCart = Cart::where('product_id', $productId)->first();
        
        if (isset($existingCart)) {
            $quantity = $request->quantity + $existingCart->quantity;
            $cart = $existingCart->update(['quantity' => $quantity]);
        } else {
            $cart = Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $productId,
                'quantity' => $request->quantity
            ]);
        }

        $product = Product::find($productId);
        $stock = $product->stock - $request->quantity;
        $product->update(['stock' => $stock]);

        return redirect()->route('cart');
    }

    public function destroyAllCart() {
        $carts = auth()->user()->carts()
                    ->with('product')
                    ->get();

        foreach ($carts as $cart) {
            $stock = $cart->quantity + $cart->product->stock;
            $cart->product()->update([ 'stock' => $stock ]);
        }

        auth()->user()->carts()->delete();

        return redirect()->route('cart');
    }

    public function destroyCart($cartId) {
        $cart = auth()->user()->carts()
                    ->with('product')
                    ->find($cartId);

        $stock = $cart->quantity + $cart->product->stock;
        $cart->product()->update([ 'stock' => $stock ]);

        $cart->delete();

        return redirect()->route('cart');
    }

    public function checkout() {
        $carts = auth()->user()->carts;

        $data = [];
        foreach ($carts as $cart) {
            array_push($data, [
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'ordered_at' => Carbon::now()
            ]);
        }

        auth()->user()->orders()->createMany($data);
        auth()->user()->carts()->delete();

        return redirect()->route('order');
    }

    public function indexOrder() {
        $orders = auth()->user()->orders()
                    ->with('product')
                    ->orderBy('updated_at', 'desc')
                    ->get();
                
        return view('user.order', compact('orders'));
    }
}
