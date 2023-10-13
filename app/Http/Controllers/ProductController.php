<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //list
    function list(){
        $product = Product::select('products.*','categories.name as category_name')
                        ->when(request('key'),function($query){
                            $query->where('products.name','like','%'.request('key').'%');
                         })
                        ->orderby('products.created_at','desc')
                        ->join('categories','products.category_id','categories.id')
                        ->paginate(2);

        //  dd($product->toarray());
        $product->appends(request()->all());

        return view('admin.product.pizzalist',compact('product'));
    }

    // createpage
    function createPage(){
        $category = Category::select(['id','name'])->get();
        // dd($category->toarray());
        return view('admin.product.create',compact('category'));
    }

    // crate product
    function create(Request $request){

        $this->valitate_product($request,'create');
        $data = $this->productcreate($request);



        $filename = uniqid().'_'.$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public/products',$filename);
        $data['image'] = $filename;

        Product::create($data);

        return redirect()->route('product#list');


    }



    // delete product
    function delete($id){
        Product::where('id',$id)->delete();

        return redirect()->route('product#list')->with(['delete'=>'Delete Sucess']);

    }
    // edit product
    function edit($id){
        $product_edit = Product::select('products.*','categories.name as category_name')
                                ->leftjoin('categories','products.category_id','categories.id')
                                ->where('products.id',$id)->first();
        // dd($product_edit->toarray());
        return view('admin.product.edit',compact('product_edit'));
    }
    // update product page
    function updatepage($id){
        $product = Product::where('id',$id)->first();
        $category = Category::get();

        return view('admin.product.update',compact('product','category'));
    }

    // update data
    function update(Request $request){
        $this->valitate_product($request,'update');
        $data = $this->productcreate($request);

        if($request->hasFile('pizzaImage')){
           $oldname = Product::where('id',$request->pizzaId)->first();
           $oldname = $oldname->image;

           if($oldname != null){
            Storage::delete('public/products/'.$oldname);
           }

           $newimg = uniqid()."_".$request->file('pizzaImage')->getClientOriginalName();
        //    dd($newimg);

           $request->file('pizzaImage')->storeAs('public/products/',$newimg);

           $data['image'] = $newimg;
        }
        Product::where('id',$request->pizzaId)->update($data);

        return redirect()->route('product#list');

    }
    // sert data product
    private function productcreate($request){
        return [

            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,

            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time'=>$request->pizzaWaiting

        ];
    }
    // validator product check
    private function valitate_product($request,$action){

        // dd($request->all());
        $validaterule = [
            'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaWaiting' => 'required'

        ];
        $validaterule['pizzaImage'] = $action == 'create' ? 'required|mimes:png,jpg,jpeg' : 'mimes:png,jpg,jpeg';
        // dd($validaterule);
        Validator::make($request->all(), $validaterule )->validate();
    }
}
