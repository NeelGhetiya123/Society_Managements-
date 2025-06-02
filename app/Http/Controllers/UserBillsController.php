<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Bill;
use Illuminate\Http\Request;

class UserBillsController extends Controller
{
    public function showBillList()
    {
        $userId = session('LoggedUserInfo');
        if (!$userId || !$LoggedUserInfo = User::find($userId)) {
            return redirect()->route('user.login')->with('fail', 'You must be logged in to access the bills page');
        }

        $bills = Bill::paginate(10);

        return view('user.bill', compact('LoggedUserInfo', 'bills'));
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
            'billTitel' => 'string|max:255',
            'flatsNo' => 'string|max:255',
            'month' => 'string|max:255',
            'paidAmount' => 'required|numeric',
            'updated_at' => 'current_date',
        ]);

        $bill = Bill::findOrFail($id);
        $bill->update($validatedData);

        return redirect()->route('user.bill')->with('success', 'Bill updated successfully.');
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
