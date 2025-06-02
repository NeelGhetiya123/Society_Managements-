<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Announcement;
use Illuminate\Http\Request;

class UserAnnouncementsController extends Controller
{
    public function showAnnouncementList(Request $request)
    {
        $userId = session('LoggedUserInfo');
        if (!$userId || !$LoggedUserInfo = User::find($userId)) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the Announcements page');
        }

        $perPage = $request->get('perPage', 10);
        $announcements = Announcement::paginate($perPage);

        return view('user.announcement', compact('LoggedUserInfo', 'announcements'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'announcedDate' => 'current_date',
            'eventDate' => 'required|date',
            'title' => 'required|string',
        ]);

        Announcement::create($validatedData);

        return redirect()->route('admin.announcement')->with('success', 'Announcement added successfully');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'eventDate' => 'required|date',
            'title' => 'required|string',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($validatedData);

        return redirect()->route('admin.announcement')->with('success', 'Announcement updated successfully.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        $this->rearrangeAnnouncementIds();
        $this->resetAutoIncrement();

        return redirect()->route('admin.announcement')->with('success', 'Announcement deleted successfully.');
    }

    public function rearrangeAnnouncementIds()
    {
        $announcements = Announcement::orderBy('id')->get();

        foreach ($announcements as $index => $announcement) {
            $announcement->id = $index + 1;
            $announcement->save();
        }
    }

    public function resetAutoIncrement()
    {
        $maxId = Announcement::max('id');
        \DB::statement('ALTER TABLE announcements AUTO_INCREMENT = ' . ($maxId + 1));
    }
}
