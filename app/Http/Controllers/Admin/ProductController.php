<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use JD\Cloudder\Facades\Cloudder;
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
            'image' => 'image|mimes:jpeg,png,jpg|max:1048',
            'price' => 'required|min:1',
            'stock' => 'required|min:1',
        ]);

        $fileName = $request->file('image')->getRealPath();
        // Storage::disk(config('filesystems.default'))->putFileAs('uploads/products', $request->image, $fileName);

        Cloudder::upload($fileName, null, array(
            "folder" => "dtks5jine",  "overwrite" => FALSE,
            "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "250", "height" => "250", "crop" => "scale")
        ));

        $width = 250;
        $height = 250;

        $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale","quality" => 70, "secure" => "true"]);

        Product::create([
            'name' => $request->name,
            'image' => $image_url,
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
            'image' => 'image|mimes:jpeg,png,jpg|max:1048',
            'price' => 'required|min:1',
            'stock' => 'required|min:1',
        ]);

        if (isset($request->image)) {
            $fileName = $request->file('image')->getRealPath();
            // Storage::disk(config('filesystems.default'))->putFileAs('uploads/products', $request->image, $fileName);

            Cloudder::upload($fileName, null, array(
                "folder" => "dtks5jine",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "250", "height" => "250", "crop" => "scale")
            ));
    
            $width = 250;
            $height = 250;
    
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale","quality" => 70, "secure" => "true"]);

        } else {
            $image_url = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'image' => $image_url,
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
