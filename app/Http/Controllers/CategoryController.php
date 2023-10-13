<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // list

    public function list(){


        $categorys = Category::when(request('key'),function($query){
                                $query->where('name','like','%'.request('key').'%');
                            })
                            ->orderby('id','desc')->paginate(4);



        // dd($categorys);

        $categorys->appends(request()->query());


        return view('admin.category.list',compact('categorys'));
    }

    //create category
    public function createpage(){
        return view('admin.category.create');
    }

    //create catgory item
    public function create(Request $request){
        $this->categoryvalidatecheck($request);
        $data = $this->createcategory($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['create'=>'Create Success']);

    }

    //delete category
    function delete($id){
       Category::where('id',$id)->delete();
       return back()->with(['delete'=>'Delete Success']);
    }

    // edit
    public function edit($id){
       $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // update
    public function update(Request $request){


        $this->categoryvalidatecheck($request);
        $data = $this->createcategory($request);
        Category::where('id',$request->categoryid)->update($data);
        return redirect()->route('category#list')->with(['update'=>'update success']);

    }

    //categoryvalidatecheck
    private function categoryvalidatecheck($request){

        Validator::make($request->all(),['categoryName' => 'required|unique:categories,name,'.$request->categoryid])->validate();

    }

    // createcategory
    private function createcategory($request){
        return [
            'name' =>$request->categoryName
        ];
    }
}
