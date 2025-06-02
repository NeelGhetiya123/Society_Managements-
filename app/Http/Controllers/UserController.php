<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('user.login');
    }

    /**
     * Show the register page.
     *
     * @return \Illuminate\View\View
     */
    public function showRegister()
    {
        return view('user.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.login')->with('success', 'Registration successful. Please login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12',
        ]);
    
        $userInfo = User::where('email', $request->input('email'))->first();
    
        if (!$userInfo) {
            return back()->withInput()->withErrors(['email' => 'Email not found']);
        }
    
        if (!Hash::check($request->input('password'), $userInfo->password)) {
            return back()->withInput()->withErrors(['password' => 'Incorrect password']);
        }
    
        $request->session()->put('LoggedUserInfo', $userInfo->id);
    
        return redirect()->route('user.dashboard');

    }
    public function showDashboard()
    {
        $LoggedUserInfo = User::find(session('LoggedUserInfo'));

        if (!$LoggedUserInfo) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the dashboard');
        }

        return view('user.dashboard', [
            'LoggedUserInfo' => $LoggedUserInfo,
        ]);
    }

    public function showFlats()
    {
        $LoggedUserInfo = User::find(session('LoggedUserInfo'));

        if (!$LoggedUserInfo) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the flats');
        }

        return view('user.flats', [
            'LoggedUserInfo' => $LoggedUserInfo,
        ]);
    }
    public function showBills()
    {
        $LoggedUserInfo = User::find(session('LoggedUserInfo'));

        if (!$LoggedUserInfo) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the bills');
        }

        return view('user.bills', [
            'LoggedUserInfo' => $LoggedUserInfo,
        ]);
    }
    public function showComplaints()
    {
        $LoggedUserInfo = User::find(session('LoggedUserInfo'));

        if (!$LoggedUserInfo) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the complaints');
        }

        return view('user.complaints', [
            'LoggedUserInfo' => $LoggedUserInfo,
        ]);
    }
    public function showVisitor()
    {
        $LoggedUserInfo = User::find(session('LoggedUserInfo'));

        if (!$LoggedUserInfo) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the visitor');
        }

        return view('user.visitor', [
            'LoggedUserInfo' => $LoggedUserInfo,
        ]);
    }

    public function showAnnouncement()
    {
        $LoggedUserInfo = User::find(session('LoggedUserInfo'));

        if (!$LoggedUserInfo) {
            return redirect()->route('User.login')->with('fail', 'You must be logged in to access the Announcement');
        }

        return view('user.announcement', [
            'LoggedUserInfo' => $LoggedUserInfo,
        ]);
    }


    public function showProfile(Request $request)
    {
        $LoggedUserInfo = User::find(session('LoggedUserInfo'));

        if (!$LoggedUserInfo) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the profile page');
        }

        return view('user.profile', [
            'LoggedUserInfo' => $LoggedUserInfo,
        ]);
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::find(session('LoggedUserInfo'));

        if (!$user) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to update the profile');
        }

        $user->name = $request->input('name');
        $user->bio = $request->input('bio');

        if ($request->hasFile('picture')) {
            if ($user->picture) {
                Storage::disk('public')->delete($user->picture);
            }

            $file = $request->file('picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            
            $user->picture = $path;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }


    public function logout()
    {
        session()->forget('LoggedUserInfo');
        return redirect()->route('user.login')->with('success', 'Logged out successfully');
    }
}
