<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Flat;
use App\Models\Member;
use Illuminate\Http\Request;

class FlatsController extends Controller
{
    public function showFlatList(Request $request)
    {
        $adminId = session('LoggedAdminInfo');
        if (!$adminId || !$LoggedAdminInfo = Admin::find($adminId)) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the flats page');
        }

        $perPage = $request->get('perPage', 10);
        $flats = Flat::paginate($perPage);

        return view('admin.flat', compact('LoggedAdminInfo', 'flats'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'allotedTo' => 'required|string|max:255',
            'flatNo' => 'required|integer',
            'blockNo' => 'required|string',
            'phoneNo' => 'required|numeric|digits:10',
            'type' => 'required|string|max:255',
            'created_at' => 'required|date',
        ]);

        Flat::create($validatedData);

        return redirect()->route('admin.flat')->with('success', 'Flat added successfully');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'allotedTo' => 'required|string|max:255',
            'flatNo' => 'required|integer',
            'blockNo' => 'required|string',
            'phoneNo' => 'required|numeric|digits:10',
            'type' => 'required|string|max:255',
            'created_at' => 'required|date',
        ]);

        $flat = Flat::findOrFail($id);
        $flat->update($validatedData);

        return redirect()->route('admin.flat')->with('success', 'Flat updated successfully.');
    }

    public function destroy($id)
    {
        $flat = Flat::findOrFail($id);
        $flat->delete();

        $this->rearrangeFlatIds();
        $this->resetAutoIncrement();

        return redirect()->route('admin.flat')->with('success', 'Flat deleted successfully.');
    }

    public function rearrangeFlatIds()
    {
        $flats = Flat::orderBy('id')->get();

        foreach ($flats as $index => $flat) {
            $flat->id = $index + 1;
            $flat->save();
        }
    }

    public function resetAutoIncrement()
    {
        $maxId = Flat::max('id');
        \DB::statement('ALTER TABLE flats AUTO_INCREMENT = ' . ($maxId + 1));
    }
}
