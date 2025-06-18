<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $rewards = Reward::all();
    return view('admin.rewards.index', compact('rewards'));
}

public function create()
{
    return view('admin.rewards.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'points_required' => 'required|integer',
        'stock_quantity' => 'required|integer',
    ]);

    Reward::create($request->all());
    return redirect()->route('admin.rewards.index')->with('success', 'Reward created!');
}

public function edit(Reward $reward)
{
    return view('admin.rewards.edit', compact('reward'));
}

public function update(Request $request, Reward $reward)
{
    $reward->update($request->all());
    return redirect()->route('admin.rewards.index')->with('success', 'Reward updated!');
}

public function destroy(Reward $reward)
{
    $reward->delete();
    return back()->with('success', 'Reward deleted!');
}

}
