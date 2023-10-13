<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    //change password page show
    function changePasswordPage(){
        return view('admin.account.changepassword');
    }

    // change password
    function changepassword(Request $request){
        // dd($request->all());
        $this->passwordvalidatemessage($request);


        $userCurrentPassword = User::where('id',Auth::user()->id)->first()->password;
        // dd($userCurrentPassword);

        if(Hash::check($request->currentPassword, $userCurrentPassword)){
            User::where('id',Auth::user()->id)->update(['password'=>Hash::make($request->confirmPassword)]);
            Auth::logout();

            return redirect()->route('Auth#login');
        }else{
            return back()->with(['incorrect'=>'Current Password is Incorrect']);
        }
    }

    // direct details
    function details(){
        return view('admin.account.detail');
    }

    // edit profile
    function edit(){
        return view('admin.account.edit');
    }

    // /update data account
    function update($id,Request $request){


        // dd($request->all());
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
        return redirect()->route('admin#details');
    }


    // admin list
    function list(){
        $admin =User::when(request('key'),function($query){
                        $query->orwhere('name','like','%'.request('key').'%')
                        ->orwhere('address','like','%'.request('key').'%');
                    })

                    ->where('role','admin')

                    ->paginate(2);
        // dd($admin->toarray());
        return view('admin.account.list',compact('admin'));
    }

    // account delete
    function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['delete'=>'delete success']);

    }

    // change role page
    function changerole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changerole',compact('account'));
    }
    // change role
    function change($id,Request $request){
        // dd($request->all());
        $data = $this->changeroleinfo($request);

        User::where('id',$id)->update($data);

        return redirect()->route('admin#list');
    }

    private function changeroleinfo($request){
        return [
            'role' => $request->role
        ];
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
    //validate
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
    private function passwordvalidatemessage($request){
        Validator::make($request->all(),[
            'currentPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
