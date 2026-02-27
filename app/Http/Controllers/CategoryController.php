<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|min:3|max:50',
                'colocation_id' => 'required|int|min:1',
            ]);

            Category::created([
                'name' => $request->name,
                'colocation_id' => $request->colocation_id,
            ]);


        } catch (Exception $e) {
            dd('error');
        }
    }


    public function delete(int $id) {
        return Category::find($id)->delete() ;
    }
}
