<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
// use Intervention\Image\Image;
// use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dash_name = Auth::user()->name; //Home page
        return view('home',compact('dash_name'));
    }
    function users(){
        $all_users = User::where('id', '!=', Auth:: id())->paginate(1); //user page
        $total_users = User::count();
        return view('admin.users.users', compact('all_users','total_users'));
    }

    //delete
    function user_delete($user_id){
        User::find($user_id)->delete();
        return back();
    }

    //dashboard
    function dash(){
        return view('layouts.dashboard');
    }

    //profile
    function profile(){
        return view('admin.users.profile');
    }
    //name_update
    function name_update(Request $request){
      User::find(Auth::id())->update([
        'name' => $request-> name,
        'updated_at' => Carbon::now(),
      ]);
     // return back();
    return redirect('/home');
    }
    //pass update
    function pass_update(Request $request){
    $request -> validate([
        'old_password' => 'required',
        'new_password' => 'required',
        'new_password' => Password::min(6)
        ->letters()
        ->mixedCase()
        ->numbers()
        ->symbols(),
        'new_password' => 'confirmed',

    ]);
    if(Hash::check($request->old_password,Auth::user()->password)){
        if(Hash::check($request->new_password, Auth::user()->password)){
            return back()-> with('same_pass','You already used this password');

        }
        else{
           User:: find(Auth:: id())-> update([
               'password' => bcrypt($request -> new_password),
           ]);
           return back();
        }
    }
    else{
        return back()-> with('wrong_pass','Old password doesn;t match');
    }
    // return redirect('/home');
    }

    //PHOTO_UPDATE
    function photo_update(Request $request){
        $request -> validate([
            // 'profile_photo' => 'mimes:jpg,bmp,png,jpeg',
            'profile_photo' => 'image',
            'profile_photo' => 'file|max:2048',
        ]);

      $upload_photo = $request -> profile_photo;
        $extention = $upload_photo -> getClientOriginalExtension();

        $filename = Auth::id().'.'.$extention;

        if(Auth::user()->profile_photo == "default-avatar.png"){
            Image::make($upload_photo)->save(public_path('/uploads/users/'.$filename)); //public_path = assets

            User::find(Auth::id())->update([
            'profile_photo'=>$filename,
        ]);
        return back();
        }
        else{
            $delete_from = public_path('/uploads/users/'.Auth::user()->profile_photo);
            unlink($delete_from);
            Image::make($upload_photo)->save(public_path('/uploads/users/'.$filename)); //public_path = assets

            User::find(Auth::id())->update([
            'profile_photo'=>$filename,
        ]);
        return back();
        }
    }

}

