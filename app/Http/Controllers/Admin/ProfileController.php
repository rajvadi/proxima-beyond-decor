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
}
