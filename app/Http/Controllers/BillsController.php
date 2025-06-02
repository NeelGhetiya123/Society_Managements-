<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillsController extends Controller
{
    public function showBillList()
    {
        $adminId = session('LoggedAdminInfo');
        if (!$adminId || !$LoggedAdminInfo = Admin::find($adminId)) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the bills page');
        }
        $bills = Bill::paginate(10);
        return view('admin.bill', compact('LoggedAdminInfo', 'bills'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'billTitel' => 'required|string|max:255',
            'flatsNo' => 'required|integer',
            'billAmount' => 'required|numeric',
            'month' => 'required|string|max:255',
            'updated_at' => 'current_date',
        ]);
        Bill::create($validatedData);
        return redirect()->route('admin.bill')->with('success', 'Bill added successfully');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'billTitel' => 'required|string|max:255',
            'flatsNo' => 'required|string|max:255',
            'billAmount' => 'required|numeric',
            'month' => 'required|string|max:255',
            'paidAmount' => 'required|numeric',
            'updated_at' => 'current_date',
        ]);

        $bill = Bill::findOrFail($id);
        $bill->update($validatedData);

        return redirect()->route('admin.bill')->with('success', 'Bill updated successfully.');
    }

    public function destroy($id)
    {
        Bill::findOrFail($id)->delete();

        $this->rearrangeBillIds();
        $this->resetAutoIncrement();

        return redirect()->route('admin.bill')->with('success', 'Bill deleted successfully.');
    }

    public function rearrangeBillIds()
    {
        // Fetch all bills ordered by their current ID
        $bills = Bill::orderBy('id')->get();

        foreach ($bills as $index => $bill) {
            $bill->id = $index + 1;
            $bill->save();
        }
    }

    public function resetAutoIncrement()
    {
        $maxId = Bill::max('id');
        \DB::statement('ALTER TABLE bills AUTO_INCREMENT = ' . ($maxId + 1));
    }
}
