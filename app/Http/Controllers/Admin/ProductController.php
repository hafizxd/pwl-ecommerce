<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create() {
        return view('admin.products.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'price' => 'required|min:1',
            'stock' => 'required|min:1',
        ]);

        $fileName = $request->image->hashName();
        $request->file('image')->storeAs('public/uploads/products' , $fileName);

        Product::create([
            'name' => $request->name,
            'image' => $fileName,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description
        ]);

        return redirect()->route('admin.product');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update($id, Request $request) {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
            'price' => 'required|min:1',
            'stock' => 'required|min:1',
        ]);

        if (isset($request->image)) {
            $fileName = $request->image->hashName();
            $request->file('image')->storeAs('public/uploads/products' , $fileName);
        } else {
            $fileName = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'image' => $fileName,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description
        ]);

        return redirect()->route('admin.product');
    }

    public function delete($id) {
        Product::destroy($id);

        return redirect()->route('admin.product');
    }
}
