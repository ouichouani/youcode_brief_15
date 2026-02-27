<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Membership;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class MembershipController extends Controller
{

public function kick(Request $request)
{
    try {

        $request->validate([
            'member_id' => 'required|integer|exists:users,id',
            'colocation_id' => 'required|integer|exists:colocations,id',
        ]);

        $authUser = Auth::user();

        $colocation = Colocation::find($request->colocation_id);
        if (!$colocation) throw new Exception('Colocation not found.');

        $isOwner = $colocation->owner == $authUser->id;
        $isAdmin = $authUser->admin == true;

        if (!$isOwner && !$isAdmin) throw new Exception('Unauthorized action.');
        if ($request->member_id == $colocation->owner) throw new Exception('You cannot kick the owner of this colocation.');

        $membership = Membership::where('member_id', $request->member_id)
            ->where('colocation_id', $request->colocation_id)
            ->first();

        if (!$membership) throw new Exception('Membership not found.');
        if ($membership->status === 'invalid') throw new Exception('Member is already inactive.');

        $membership->update([
            'status' => 'invalid',
        ]);

        $user = User::find($request->member_id);
        $user->update([
            'ismember' => false,
        ]);

        return redirect()->back()->with('success', 'Member has been kicked successfully.');

    } catch (Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}
}
