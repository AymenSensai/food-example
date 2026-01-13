<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FoodItem;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class FoodItemController extends Controller
{
    public function index(Request $request)
    {
        $query = FoodItem::with('category');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $foodItems = $query->get();
        return view('admin.food-items.index', compact('foodItems'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.food-items.create', compact('categories'));
    }

    public function store(Request $request, ImageService $imageService)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $imageService->compressAndStore($request->file('image'), 'food-items');
            $data['image'] = $path;
        }

        FoodItem::create($data);

        return redirect()->route('admin.food-items.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(FoodItem $foodItem)
    {
        $categories = Category::all();
        return view('admin.food-items.edit', compact('foodItem', 'categories'));
    }

    public function update(Request $request, FoodItem $foodItem, ImageService $imageService)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($foodItem->image) {
                Storage::disk('public')->delete($foodItem->image);
            }
            $path = $imageService->compressAndStore($request->file('image'), 'food-items');
            $data['image'] = $path;
        }

        $foodItem->update($data);

        return redirect()->route('admin.food-items.index')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(FoodItem $foodItem)
    {
        if ($foodItem->image) {
            Storage::disk('public')->delete($foodItem->image);
        }
        $foodItem->delete();
        return redirect()->route('admin.food-items.index')->with('success', 'Article supprimé avec succès.');
    }
}
