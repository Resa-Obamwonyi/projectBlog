<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use App\Profile;


class ProfileController extends Controller
{
    public function profile(){
        return view('profiles.profile');
    }

public function addProfile(Request $request){
        $this->validate($request, [
            'name'=> 'required',
            'designation'=> 'required',
            'profile_pic'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);

     // to dump array print_r($request->file());
    
    //$folderpath = public_path('/profilepic');

    //to upload image file

    //dd($path);
    if ($request->hasFile('profile_pic')) {
        $extension = $request->file('profile_pic')->getClientOriginalExtension();
        $file = md5(uniqid()) . '.' .$extension;
        $path = $request->file('profile_pic')->storeAs('public/profilepic', $file);
     }

        $profile = Profile::forceCreate([
            "name" => request('name'),
            "user_id" => auth()->user()->id,
            "designation" => request('designation'),
            "profile_pic" => $file,
            
        ]);
   
    return redirect()->to('/home')->withSuccess('Great! Image has been successfully uploaded.');
    }
}
