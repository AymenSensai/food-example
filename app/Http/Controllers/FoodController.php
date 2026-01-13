<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $foodItems = \App\Models\FoodItem::where('name', 'ilike', "%{$search}%")
                ->with('category')
                ->get();
            $categories = collect(); // Empty collection to avoid errors if view expects it
        } else {
            $foodItems = collect();
            $categories = Category::all();
        }

        return view('food.index', compact('categories', 'foodItems', 'search'));
    }

    public function show(Category $category)
    {
        $category->load('foodItems');
        return view('food.show', compact('category'));
    }
}
