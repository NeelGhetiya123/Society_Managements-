<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Member;
use App\Models\User;
use App\Models\Flat;
use App\Models\Bill;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Show the register page.
     *
     * @return \Illuminate\View\View
     */
    public function showRegister()
    {
        return view('admin.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
        ]);

        // Create a new admin
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password); // Hash the password before saving
        $admin->save();

        // Redirect to the login page with a success message
        return redirect()->route('admin.login')->with('success', 'Registration successful. Please login.');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12',
        ]);
    
        $adminInfo = Admin::where('email', $request->input('email'))->first();
    
        // Check if admin exists
        if (!$adminInfo) {
            return back()->withInput()->withErrors(['email' => 'Email not found']);
        }
    
        // Check if the provided password matches the hashed password
        if (!Hash::check($request->input('password'), $adminInfo->password)) {
            return back()->withInput()->withErrors(['password' => 'Incorrect password']);
        }
    
        // Store admin ID in the session
        $request->session()->put('LoggedAdminInfo', $adminInfo->id);
    
        // Redirect to the dashboard
        return redirect()->route('admin.dashboard');

        // Redirect to the flats
        //return redirect()->route('admin.flats');

        // Redirect to the bills
        //return redirect()->route('admin.bills');

        // Redirect to the complaint
        //return redirect()->route('admin.complaints');

        // Redirect to the visitor
        //return redirect()->route('admin.visitor');
    }
    
    

public function showDashboard()
{
    $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

    if (!$LoggedAdminInfo) {
        return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
    }

    // Count total members
    $totalMembers = Member::count();
    $totalFlats = Flat::count();
    $totalBills = Bill::count();
    $totalComplaints = Complaint::count();


    return view('admin.dashboard', [
        'LoggedAdminInfo' => $LoggedAdminInfo,
        'totalMembers' => $totalMembers,
        'totalFlats' => $totalFlats,
        'totalBills' => $totalBills,
        'totalComplaints' => $totalComplaints,
    ]);
}



    public function showFlats()
    {
        $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the flats');
        }

        return view('admin.flats', [
            'LoggedAdminInfo' => $LoggedAdminInfo,
        ]);
    }
    public function showBills()
    {
        $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the bills');
        }

        return view('admin.bills', [
            'LoggedAdminInfo' => $LoggedAdminInfo,
        ]);
    }
    public function showComplaints()
    {
        $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the complaints');
        }

        return view('admin.complaints', [
            'LoggedAdminInfo' => $LoggedAdminInfo,
        ]);
    }
    public function showVisitor()
    {
        $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the visitor');
        }

        return view('admin.visitor', [
            'LoggedAdminInfo' => $LoggedAdminInfo,
        ]);
    }

    public function showAnnouncement()
    {
        $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the Announcement');
        }

        return view('admin.announcement', [
            'LoggedAdminInfo' => $LoggedAdminInfo,
        ]);
    }


    public function showProfile(Request $request)
    {
        $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the profile page');
        }

        return view('admin.profile', [
            'LoggedAdminInfo' => $LoggedAdminInfo,
        ]);
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin = Admin::find(session('LoggedAdminInfo'));

        if (!$admin) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to update the profile');
        }

        // Update the admin's information
        $admin->name = $request->input('name');
        $admin->bio = $request->input('bio');

        // Handle the profile picture upload
        if ($request->hasFile('picture')) {
            // Delete old picture if it exists
            if ($admin->picture) {
                Storage::disk('public')->delete($admin->picture);
            }

            // Store the new picture
            $file = $request->file('picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            
            $admin->picture = $path;
        }

        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
    }


    public function logout()
    {
        // Clear the session data for the logged-in admin
        session()->forget('LoggedAdminInfo');
        
        // Redirect to the login page
        return redirect()->route('admin.login');
    }
    
    
    public function showMemberList()
    {
        $members = Member::all(); // You might want to paginate or filter members
        $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the profile page');
        }
    
        // Pass the admin data to the profile view
        return view('admin.member', [
            'LoggedAdminInfo' => $LoggedAdminInfo,
            'members' => $members
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'flatNo' => 'required|integer',
            'memberPhone' => 'required|numeric|digits:10',
            'email' => 'required|email|max:255|unique:members',
            'role' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
     
        // Create a new Member instance
        $member = new Member();
        $member->name = $request->name;
        $member->flatNo = $request->flatNo;
        $member->memberPhone = $request->memberPhone;
        $member->email = $request->email;
        $member->role = $request->role;
     
        // Handle the picture file upload
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            $member->picture = $path;
        }
     
        $member->save();
     
        return redirect()->route('admin.member')->with('success', 'Member created successfully.');
    }
     
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'flatNo' => 'required|integer',
            'memberPhone' => 'required|numeric|digits:10',
            'email' => 'required|email|max:255',
            'role' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
 
        $member = Member::findOrFail($id);
        $member->name = $request->name;
        $member->flatNo = $request->flatNo;
        $member->memberPhone = $request->memberPhone;
        $member->email = $request->email;
        $member->role = $request->role;
 
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            $member->picture = $path;
        }
        $member->save();
 
        return redirect()->route('admin.member')->with('success', 'Member updated successfully.');
    }
 
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
 
        return redirect()->route('admin.member')->with('success', 'Member deleted successfully.');
    }
}
