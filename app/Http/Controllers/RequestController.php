<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Membership;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{

    public function index()
    {
        // $user = Auth::user();
                $user = User::inRandomOrder()->first();

        $isAlreadyInColocation = $user->colocations()->orderBy('created_at')->first()?->status == 'active' ;

        $requests = ModelsRequest::with('colocations')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('requests.index', compact('requests' , 'isAlreadyInColocation'));
    }

    public function create()
    {
        return view('Request.create');
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'colocation_id' => 'required|int|min:1',
                'email' => 'required|email',
            ]);

            $authUser = Auth::user();

            $user = User::where('email', $request->email)->first();
            if (!$user) throw new Exception('User not found');

            if ($authUser->id === $user->id) {
                throw new Exception('You cannot send invitation to yourself.');
            }

            $colocation = Colocation::find($request->colocation_id);
            if (!$colocation) throw new Exception('Colocation not found.');

            $alreadyMember = Membership::where('member_id', $user->id)
                ->where('colocation_id', $request->colocation_id)
                ->exists();

            if ($alreadyMember) {
                throw new Exception('User is already a member of this colocation.');
            }

            $existingRequest = ModelsRequest::where('user_id', $user->id)
                ->where('colocation_id', $request->colocation_id)
                ->exists();

            if ($existingRequest) {
                throw new Exception('Request already sent.');
            }

            ModelsRequest::create([
                'user_id' => $user->id,
                'colocation_id' => $request->colocation_id,
                'status' => 'pending'
            ]);

            return redirect()->back()->with('success', 'Invitation sent successfully.');
        } catch (Exception $e) {
            // return redirect()->back()->with('error', $e->getMessage());
            dd($e->getMessage());
        }
    }

    public function accept($id)
    {
        try {

            $request = ModelsRequest::find($id);
            if (!$request) throw new Exception('Request not found.');

            $user = User::find($request->user_id);
            $colocation = Colocation::find($request->colocation_id);


            $activeMembership = $user->colocations()->wherePivot('status', 'active')->exists();
            if ($activeMembership) throw new Exception('User is already in an active colocation. They must leave it first.');


            $request->update(['status' => 'accepted']);

            Membership::create([
                'member_id' => $user->id,
                'colocation_id' => $colocation->id,
            ]);

            return redirect()->back()->with('success', 'Request accepted. User has joined the colocation.');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function reject($id)
    {
        try {
            $request = ModelsRequest::find($id);

            if (!$request) {
                throw new Exception('Request not found.');
            }

            // only allow the user who sent the request or admin to reject
            if ($request->user_id !== Auth::id() || Auth::user()->role == 'admin') {
                throw new Exception('You are not authorized to reject this request.');
            }

            $request->update([
                'status' => 'rejected',
            ]);

            return redirect()->back()->with('success', 'Request has been rejected.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        return ModelsRequest::find($id)->delete();
    }
}
