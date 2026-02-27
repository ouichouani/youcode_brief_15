<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Request as ModelsRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{


    public function index()
    {
        return redirect()->back();
    }

    public function show(Colocation $colocation)
    {
        $colocation->load(
            ['users' => function ($query) {
            $query->withSum('expenses', 'amount')
                ->withSum(['payments' => fn($q) => $q->where('is_paied', true)], 'amount');
        }]);

        $pendingRequests = ModelsRequest::where('colocation_id', $colocation->id)
            ->where('status', 'pending')
            ->with('users')
            ->get();

        
        $isAdmin = $colocation->owner === Auth::id();

        return view('colocations.show', compact('colocation', 'pendingRequests', 'isAdmin'));
    }


    public function create()
    {
        return view('colocations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categories' => 'required|array|min:1',
            'categories.*' => 'required|string|max:100',
        ]);

        // 1. Create the Colocation
        $colocation = Colocation::create([
            'name' => $request->name,
            'owner' => Auth::id(), // Auth user as owner
            'status' => 'active',    // Default active
        ]);

        // 2. Create Categories
        foreach ($request->categories as $categoryName) {
            $colocation->categories()->create([
                'name' => $categoryName
            ]);
        }

        // 3. (Optional) Auto-join owner as a member
        $colocation->users()->attach(Auth::id(), ['role' => 'owner', 'status' => 'valid']);

        return redirect()->route('dashboard')->with('success', 'Colocation created successfully!');
    }


    public function delete(int $id)
    {
        return Colocation::find($id)->delete();
    }
}
