<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    public function showVisitorList(Request $request)
    {
        $adminId = session('LoggedAdminInfo');
        if (!$adminId || !$LoggedAdminInfo = Admin::find($adminId)) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the visitors page');
        }

        $perPage = $request->get('perPage', 10);
        $visitors = Visitor::paginate($perPage);

        return view('admin.visitor', compact('LoggedAdminInfo', 'visitors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'flatNo' => 'required|integer',
            'visitorName' => 'required|string|max:255',
            'visitorPhone' => 'required|numeric|digits:10',
            'personToMeet' => 'required|string|max:255',
            'entryTime' => 'current_date',
        ]);

        // Create the new visitor
        Visitor::create($validatedData);

        return redirect()->route('admin.visitor')->with('success', 'Visitor added successfully');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'flatNo' => 'integer',
            'visitorName' => 'string|max:255',
            'visitorPhone' => 'numeric|digits:10',
            'personToMeet' => 'string|max:255',
            'exitTime' => 'required|date',
        ]);

        // Find and update the visitor
        $visitor = Visitor::findOrFail($id);
        $visitor->update($validatedData);

        return redirect()->route('admin.visitor')->with('success', 'Visitor updated successfully.');
    }

    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        $this->rearrangeVisitorIds();
        $this->resetAutoIncrement();

        return redirect()->route('admin.visitor')->with('success', 'Visitor deleted successfully.');
    }

    public function rearrangeVisitorIds()
    {
        $visitors = Visitor::orderBy('id')->get();

        foreach ($visitors as $index => $visitor) {
            $visitor->id = $index + 1;
            $visitor->save();
        }
    }

    public function resetAutoIncrement()
    {
        $maxId = Visitor::max('id');
        \DB::statement('ALTER TABLE visitors AUTO_INCREMENT = ' . ($maxId + 1));
    }
}
