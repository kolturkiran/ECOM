<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $data=Product::all();
        return view('product', ['products'=>$data]);
    }
    public function search(Request $req){       
        $data= Product::
        where('name', 'like', '%'.$req->input('query').'%')
        ->get();
        return view('search',['products'=>$data]);
    }
    public function detail($id){
        $data=Product::find($id);        
         $products=Product::
         where('id','<>', $data->id)        
         ->get(); 
        return view('detail', ['product'=>$data, 'products' => $products]);
    }
    public function addToCart(Request $req){              
        if($req->session()->has('user')){
            $cart = new Cart;
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->product_id;
            $cart->save();
            return redirect('/');
        }
        else{
            return redirect('/login');
        }
    }
    static public function cartItem(){   
            $userId = Session::get('user')['id'];        
            return Cart::where('user_id', $userId)->count();             
    }
    public function cartList(){        
        if(isset(Session::get('user')['id'])){
            $userId = Session::get('user')['id'];
            $products=DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cart_id')
            ->get();
            return view('cartlist', ['products'=>$products]);
        }else{
            return redirect('/login');
        }
        
    }
    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }
    public function orderNow(){
        $userId = Session::get('user')['id'];
        $total = DB::table('cart')
        ->join('products', 'cart.product_id', '=', 'products.id')
        ->where('cart.user_id', $userId)
        ->sum('products.price');        
        return view('ordernow', ['total'=>$total]);
    }
    public function orderPlace(Request $req){
        $userId = Session::get('user')['id'];
        if($req->product_id!=null){
            $order = new Order;
            $order->product_id = $req->product_id;
            $order->user_id = $userId;
            $order->status = "pending";
            $order->payment_method = $req->payment;
            $order->payment_status = "pending";
            $order->address = $req->address;
            $order->save();
        }           
        $allCart = Cart::where('cart.user_id', $userId)->get();
        foreach($allCart as $cart){
            $order = new Order;
            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->status = "pending";
            $order->payment_method = $req->payment;
            $order->payment_status = "pending";
            $order->address = $req->address;
            $order->save();
            Cart::where('cart.user_id', $userId)->delete();
        }
        return redirect('myorders');        
    }
    public function myOrders(){
        if(isset(Session::get('user')['id'])){
        $userId = Session::get('user')['id'];
        $orders = DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->where('orders.user_id', $userId)
        ->get();        
        return view('myorders', ['orders'=>$orders]);
        }
        else{
            return redirect('/login');
        }
    }
    public function buyNow(Request $req){
        if(isset(Session::get('user')['id'])){              
        $total = DB::table('products')        
        ->where('products.id', $req->product_id)
        ->value('products.price');        
        return view('ordernow', ['total'=>$total, 'product_id'=>$req->product_id]);
    }
        else{
            return redirect('/login');
        }
    }   
}
