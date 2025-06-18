<?php

namespace App\Http\Controllers;
use App\Models\Reward;
use App\Models\RewardRedemption;
use App\Models\LoyaltyTransaction;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RewardRedemptionController extends Controller 
{
    //

    public function index()
{
    $rewards = Reward::where('stock_quantity', '>', 0)->get();

    $approvedRewards = RewardRedemption::with('reward')
        ->where('user_id', Auth::id())
        ->get();

    return view('customer.reward', compact('rewards', 'approvedRewards'));
}

public function redeem(Request $request, $rewardId)
{
    $reward = Reward::findOrFail($rewardId);
    $user = auth()->user();

    $userPoints = LoyaltyTransaction::where('user_id', $user->id)->sum('points');

    if ($userPoints < $reward->points_required) {
        return back()->with('error', 'Not enough points.');
    }

    if ($reward->stock_quantity <= 0) {
        return back()->with('error', 'Reward out of stock.');
    }

    // Create redemption record
    RewardRedemption::create([
        'user_id' => $user->id,
        'reward_id' => $reward->id,
        'status' => 'pending',
    ]);

    // Deduct points
    LoyaltyTransaction::create([
        'user_id' => $user->id,
        'order_id' => null,
        'points' => -$reward->points_required,
        'type' => 'redeem',
        'description' => 'Redeem reward: ' . $reward->name,
    ]);

    // Decrease reward stock
    $reward->decrement('stock_quantity');

    return back()->with('success', 'Reward redeemed successfully! Waiting for approval.');
}


public function adminIndex()
{
    $redemptions = RewardRedemption::with(['user', 'reward'])->latest()->get();
    return view('admin.rewards.redemptions', compact('redemptions'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,approved,rejected',
    ]);

    $redemption = RewardRedemption::findOrFail($id);
    $redemption->status = $request->status;
    $redemption->save();

    return redirect()->route('admin.redemptions.index')->with('success', 'Status berhasil diperbarui.');
}


}
