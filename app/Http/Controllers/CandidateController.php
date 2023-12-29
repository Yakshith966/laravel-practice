<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CandidateController extends Controller
{
    public function register()
    {
        return view('Auth.register');
    }
    public function registerUser(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required | max:10' ,
            'password'=>'required | max:12'
        ]);
        $existingUser = Candidate::where('email', $request->email)->first();

    if ($existingUser) {
        return back()->with('fail', 'Email already registered. Please use a different email.');
    }

    // If the phone number does not have 10 digits
    if (strlen($request->phone) !== 10) {
        return back()->with('fail', 'Phone number must have exactly 10 digits.');
    }

        $candidate=new Candidate();
        $candidate->name=$request->name;
        $candidate->email=$request->email;
        $candidate->phone=$request->phone;
        $candidate->password=Hash::make($request->password);

        $res= $candidate->save();
        if($res)
        {
            return back()->with('success','You have Registered Succesfully');
        }
        else
        {
            return back()->with('fail','Something Wrong');
        }

    }
    public function login()
    {
        return view('Auth.login');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required | max:12'
        ]);
        $user = Candidate::where('email','=',$request->email)->first();
        $credentials = $request->only('email', 'password'); // login
        // dd(   $credentials);
        if (Auth::guard('job')->attempt($credentials)) {
            // dd(Auth::guard('job')->check());
            $request->session()->put('loginId', $user->id);
                $request->session()->put('loggedInUser', $user);
                // dd(session('loggedInUser'));
            return redirect('dashboard')->with('loggedInUser', $user);
            // return Redirect::back()->withErrors(['msg' => 'Invalid username or password']);
        }
        return back()->with('fail','User Not Found');

        // dd('gone');

        // dd($user);
        // if($user)
        // {
        //     if(Hash::check($request->password, $user->password)){
        //         $request->session()->put('loginId', $user->id);
        //         $request->session()->put('loggedInUser', $user);
        //         dd(Auth::guard('job')->check());
        //         return redirect('dashboard')->with('loggedInUser', $user);
    
        //     }
        //     else{
        //         return back()->with('fail','Password is Incorrect');
        //     }
        // }
        // else
        // {
        //     return back()->with('fail','User Not Found');
        // }
        
    


}
//     public function dashboard(Request $request)
// {
//     $user = null;
    
//     if (Session::has('loginId')) {
//         $userId = Session::get('loginId');
//         $user = Candidate::find($userId);

//         // You can also use the following to handle non-existent users
//         // $user = User::where('id', $userId)->first();
//     }

//     return view('dashboard', compact('user'));
// }
public function logoutUser(Request $request)
{
    Auth::guard('job')->logout(); // logout
    $request->session()->invalidate(); // invalidate the session
    $request->session()->regenerateToken(); // regenerate CSRF token

    return view('Auth.login')->with('success', 'Logout successful');
}
}
