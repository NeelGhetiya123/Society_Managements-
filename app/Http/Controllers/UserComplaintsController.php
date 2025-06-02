<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Complaint;
use Illuminate\Http\Request;

class UserComplaintsController extends Controller
{
    
    public function showComplaintList(Request $request)
    {
        $userId = session('LoggedUserInfo');
        if (!$userId || !$LoggedUserInfo = User::find($userId)) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the complaints page');
        }

        $perPage = $request->get('perPage', 10);
        $complaints = Complaint::paginate($perPage);

        return view('user.complaint', compact('LoggedUserInfo', 'complaints'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'memberName' => 'required|string|max:255',
            'flatNo' => 'required|integer',
            'complaint' => 'required|string',
            'memberPhone' => 'required|numeric|digits:10',
            'updated_at' => 'current_date',
        ]);

        Complaint::create($validatedData);

        return redirect()->route('user.complaint')->with('success', 'Complaint added successfully');
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        $this->rearrangeComplaintIds();
        $this->resetAutoIncrement();

        return redirect()->route('admin.complaint')->with('success', 'Complaint deleted successfully.');
    }

    public function rearrangeComplaintIds()
    {
        $complaints = Complaint::orderBy('id')->get();

        foreach ($complaints as $index => $complaint) {
            $complaint->id = $index + 1;
            $complaint->save();
        }
    }

    public function resetAutoIncrement()
    {
        $maxId = Complaint::max('id');
        \DB::statement('ALTER TABLE complaints AUTO_INCREMENT = ' . ($maxId + 1));
    }
}
