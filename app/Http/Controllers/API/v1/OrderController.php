<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addCart (Request $request)
    {
        $userId = $request->user()->id;
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $price = Product::find($productId)->harga_product;
        $carts = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        // if same product
        if ($carts != null){
            $qty = $carts->quantity;
            $newqty = $qty + ($quantity);
            Cart::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->update(['quantity' => $newqty]);
        } else {
        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->user_id = $userId;
        $cart->price = $price;
        $cart->quantity = $quantity;
        $cart->save();
        }

        return response (['success' => true]);
    }

    public function editCart (Request $request)
    {
        $userId = $request->user()->id;
        $cartId = $request->cart_id;
        $qty = $request->quantity;

        $cart = Cart::where('user_id', $userId)->find($cartId);
        if ($cart != null) {
            $cart->quantity = $qty;
            $cart->save();

            return response (['success' => $cart]);
        } else {
            return response(['error' => 'data can\'t be found'], 401);
        }
    }

    public function showCart (Request $request)
    {
        $userId = $request->user()->id;

        $cart = Cart::where('user_id', $userId)->get();

        return response(['Show Cart' => $cart]);

    }

    public function deleteCart (Request $request)
    {
        $userId = $request->user()->id;
        $cart = $request->cart_id;
        $cartId = Cart::where('user_id', $userId)->find($cart);
        $cartId->delete();

        return response (['success' => true]);
    }

    public function checkout(Request $request)
    {
        $user = $request->user();
        $userId = $user->id;
        $userDetail = $user->userDetail();

        $order = new Order();
        $order->customer = $user->name; //implode('\n', array($user->name, $userDetail->phone, $userDetail->address));
        $order->user_id = $userId;
        $order->save();

        $carts = Cart::where('user_id', $userId)->get();
        foreach($carts as $cart){
            $orderDetail = new OrderDetail();
            $orderDetail->price = $cart->price;
            $orderDetail->quantity = $cart->quantity;
            $orderDetail->product_id = $cart->product_id;
            $orderDetail->order_id = $order->id;
            $orderDetail->save();
            $cart->delete();
        }
        return response(['success' => true]);
    }

    public function showOrder (Request $request)
    {
        $userId = $request->user()->id;
        $orderId = $request->order_id;

        $order = Order::where('user_id', $userId)->find($orderId);

        return response (['list order' => $order]);
    }

    public function history (Request $request)
    {
        $userId = $request->user()->id;
        $order = Order::where('user_id', $userId)
                        ->get();

        return response(['all order' => $order]);

    }
}
