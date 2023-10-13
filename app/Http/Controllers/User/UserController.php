<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct view home page
    public function home(){
        $product = Product::orderby('created_at','desc')
                            ->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();


        return view('user.main.home',compact('product','category','cart','order'));
    }

    public function changepasswordpage(){
        return view('user.password.change');
    }


    public function changepassword(Request $request){

        $this->passwordvalidate($request);


        // dd(Auth::user()->password);

        if(Hash::check(  $request->currentPassword, Auth::user()->password)){
           $newpassword = Hash::make($request->newPassword);
           User::where('id',Auth::user()->id)->update(['password'=>$newpassword]);
           Auth::logout();

        }
        return back()->with(['incorrect'=>'current password is incorrect']);
    }

    // account change page
    function accountchangepage(){
        return view('user.account.profile');
    }

    // change account infomation
    public function accountchange($id,Request $request){
        //  dd($request->all());

         $this->updatedatavalidate($request);
         $data = $this->updatedata($request);
         // for image
         if($request->hasFile('image')){
             $dboldimage =User::where('id',$id)->first();
             $dboldimage = $dboldimage->image;
             // dd($dboldimage);
             if($dboldimage != null){
                 Storage::delete('public/'.$dboldimage);
             }
             $imagename = uniqid().'_'.$request->file('image')->getClientOriginalName();
             $request->file('image')->storeAs('public',$imagename);
             $data['image'] = $imagename;
             // dd($imagename);

         }
         User::where('id',$id)->update($data);
         return redirect()->route('user#accountchangepage')->with(['success'=>'update success']);
    }
    // pizza filter
    public function filter($categoryid){
        // dd($categoryid);;
        $product = Product::where('category_id',$categoryid)->orderby('created_at','desc')
                            ->get();
        // dd($product->toarray());
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('product','category','cart'));
    }

    // pizza detail page

    public function detail($id){
        // logger($id);
        $products = Product::where('id',$id)->first();
        $products_list = Product::get();
        return view('user.main.detail',compact('products','products_list'));
    }

    // cart
    public function cartlist(){

        $cart = Cart::select('carts.*','products.name as products_name','products.image as image','products.price as price')
                    ->join('products','carts.product_id','products.id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();
        // dd($cart->toarray());
        $totalprice=0 ;
        foreach($cart as $c){
            $totalprice += $c->price*$c->qty;
        };




        return view('user.main.cart',compact('cart','totalprice'));
    }

    // history home
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->get();
        // dd($order->toarray());
        return view('user.main.history',compact('order'));
    }

    // update data
    private function updatedata($request){
        return[
            'name' =>$request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' =>$request->gender
        ];
    }

    // validate
    private function updatedatavalidate($request){
        Validator::make($request->all(),[
            'name' =>'required',
            'email' =>'required',
            'address' =>'required',
            'phone' =>'required',
            'image' =>'mimes:png,jpg,jpeg',
            'gender' =>'required',
        ])->validate();
    }
    private function passwordvalidate($request){
        Validator::make($request->all(),[
            'currentPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',


        ])->validate();
    }

}
