<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserProfileController extends Controller
{
    public function changeProfile(){
        $user = DB::table('users')
        ->select('users.*')
        ->where('users.id', '=', auth()->id())
        ->first();

        if(auth()->user()->role === 'superadmin'){
            return view('superadmin.profile.changeProfile', compact('user'));
        }elseif(auth()->user()->role === 'admin'){
            return view('admin.profile.changeProfile', compact('user'));
        }elseif(auth()->user()->role === 'user'){
            return view('user.profile.changeProfile', compact('user'));
        }
    }

    public function updateProfile(Request $request ,User $user){
        if(empty($request->new_pass && $request->confirm_pass)){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]); 
            return redirect()->back()->with('success', 'Your Profile Data Update Successfully');
        }else{
            if($request->new_pass != $request->confirm_pass){
                return redirect()->back()->with('error', 'Your Password Does Not Match');
            }else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->new_pass,
                ]);           
            return redirect()->back()->with('success', 'Your Profile Data Update Successfully');
            }
        }
    }

    public function profileImage(Request $request ,User $user){
        $user->update([
            'profile_image' => $request->profile_image->getClientOriginalName()  
        ]); 
        $fileNameImage = $request->profile_image->getClientOriginalName();
        $filePathImage = 'storage/images/' . $fileNameImage;
        $request->profile_image->move(public_path('storage/images/'), $fileNameImage);
        return redirect()->back()->with('updateImg', 'Your Profile Image Update Successfully');
    }
}
