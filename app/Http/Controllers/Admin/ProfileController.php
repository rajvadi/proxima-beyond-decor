<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function change_password()
    {
        return view('admin.profile.change_password');
    }

    public function profile()
    {
        return view('admin.profile.profile');
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.auth()->user()->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,PNG|max:100',
        ]);

        if($request->hasFile('avatar')){
            $image_name = time() . '.' . $request->avatar->getClientOriginalExtension();
            $img = $request->avatar->storeAs('admin_avatar', $image_name, 'public');
            if(Storage::exists('public/'.auth()->user()->avatar)){
                Storage::delete('public/'.auth()->user()->avatar);
            }
            Admin::find(auth()->user()->id)->update(['avatar'=>$img]);

        }

        Admin::find(auth()->user()->id)->update($request->only('name','email'));

        return redirect()->back()->with("success","Profile updated successfully !");
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','min:6'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        Admin::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->back()->with("success","Password changed successfully !");
    }

    public function setting(){
        $setting = Setting::first();
        return view('admin.setting',compact('setting'));
    }

    public function store_setting(Request $request){
        $request->validate([
            'admob_interstitial_id' => 'nullable',
            /*'admob_native_id' => 'nullable',*/
            'admob_banner_id' => 'nullable'
        ]);

        $setting = Setting::first();
        if($setting){
            $setting->forceFill($request->only('admob_interstitial_id','admob_banner_id'))->save();
        }else{
            $setting = Setting::create($request->all());
        }

        return redirect()->back()->with("success","Setting updated successfully !");

    }
}
