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
        $rewards = Reward::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.rewards.index', compact('rewards'));
    }

    public function create()
    {
        return view('admin.rewards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:150',
            'points_required' => 'required|integer|min:0',
            'stock_quantity'  => 'required|integer|min:0',
            'description'     => 'nullable|string',
            'image'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('rewards', 'public');
        }

        Reward::create($validated);

        return redirect()->route('admin.rewards.index')
                         ->with('success', 'Reward berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $reward = Reward::findOrFail($id);
        return view('admin.rewards.edit', compact('reward'));
    }

    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);

        $validated = $request->validate([
            'name'            => 'required|string|max:150',
            'points_required' => 'required|integer|min:0',
            'stock_quantity'  => 'required|integer|min:0',
            'description'     => 'nullable|string',
            'image'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus file lama
            if ($reward->image_url && Storage::disk('public')->exists($reward->image_url)) {
                Storage::disk('public')->delete($reward->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('rewards', 'public');
        }

        $reward->update($validated);

        return redirect()->route('admin.rewards.index')
                         ->with('success', 'Reward berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);
        if ($reward->image_url && Storage::disk('public')->exists($reward->image_url)) {
            Storage::disk('public')->delete($reward->image_url);
        }
        $reward->delete();

        return redirect()->route('admin.rewards.index')
                         ->with('success', 'Reward berhasil dihapus.');
    }
}



    
