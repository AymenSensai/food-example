<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FoodItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categoriesCount = Category::count();
        $foodItemsCount = FoodItem::count();
        $latestItems = FoodItem::with('category')->latest()->take(5)->get();

        return view('dashboard', compact('categoriesCount', 'foodItemsCount', 'latestItems'));
    }
}
