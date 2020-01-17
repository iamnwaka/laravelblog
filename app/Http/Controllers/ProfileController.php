<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\URL;
use App\Profile;
use Auth;

class ProfileController extends Controller
{
   
    public function profile (){
        return view('profiles.profile');
    }

    public function addProfile(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'Designation'=>'required',
            'profile_pic'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $profiles =new Profile;
        $profiles->name =$request->input('name');
        $profiles->user_id =Auth::user()->id;
        $profiles->Designation =$request->input('Designation');
        

        if($request->hasfile('profile_pic')){
            $file=$request->file('profile_pic')->getClientOriginalName();
            $fileWithoutExt=pathinfo($file, PATHINFO_FILENAME);
            // dd($fileWithoutExt);
            $extension=$request->file('profile_pic')->getClientOriginalName();
            $fileTostore=$fileWithoutExt.'_'.time().'.'.$extension;
            $request->file('profile_pic')->storeAs('public/uploads/',$fileTostore);
            
            $profiles =new Profile;
            $profiles->name =$request->input('name');
            $profiles->user_id =Auth::user()->id;
            $profiles->Designation =$request->input('Designation');
            $profiles->profile_pic = $fileTostore;
            $profiles->save();

            return redirect ('/home')->with('response', 'Profile Added Succesfully');
        }
        

    
       
        
    }
       
}
