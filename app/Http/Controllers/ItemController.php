<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::paginate(20);

        return view('item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'image'         => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'name'         => 'required|string',
            'description'   => 'required|string',
        ]);

        $image = $request->file('image');
        $image->storeAs('items', $image->hashName());

        Item::create([
            'category_id' => $request->category,
            'image'         => $image->hashName(),
            'name'         => $request->name,
            'description'   => $request->description,
        ]);

        return redirect()->route('item.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::get();

        return view('item.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'category' => 'required',
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'         => 'required|string',
            'description'   => 'required|string',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image->storeAs('items', $image->hashName());

            Storage::delete('public/products/'.$item->image);

            $item->update([
                'category_id' => $request->category,
                'image'         => $image->hashName(),
                'name'         => $request->name,
                'description'   => $request->description,
            ]);

        } else {
            $item->update([
                'category_id' => $request->category,
                'name'         => $request->name,
                'description'   => $request->description,
            ]);
        }

        return redirect()->route('item.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('item.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
