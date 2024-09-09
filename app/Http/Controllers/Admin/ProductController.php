<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Product::query())
                ->addIndexColumn()
                ->editColumn('image', function ($product) {
                    return '<img src="'.$product->images->first()->image_url.'" width="100px" height="100px">';
                })
                ->rawColumns(['image'])->make(true);
        }
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'description' => 'nullable',
            'material' => 'nullable',
            'finishes' => 'nullable',
        ]);
        //dd($request->all());

        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->description = $request->description;
        $product->material = $request->material;
        $product->finishes = $request->finishes;
        if ($product->save()) {
            $product_id = $product->id;
            $attributes = $request->get('attributes');
            $values = $request->get('values');
            foreach ($attributes as $index => $attributeData) {
                // Create or find the attribute
                $attribute = Attribute::firstOrCreate(['name' => $attributeData['name']]);

                // Link the product to the attribute
                $productAttribute = ProductAttribute::create([
                    'product_id' => $product->id,
                    'attribute_id' => $attribute->id,
                ]);

                // Loop through the values to create the attribute values
                foreach ($values as $value) {
                    // Save each attribute value
                    AttributeValue::create([
                        'product_attribute_id' => $productAttribute->id,
                        'value' => $value[$index],
                    ]);
                }
            }

            // upload base64 images
            $images = $request->get('product_images');
            foreach ($images as $index => $image) {
                $image_parts = explode(";base64,", $image);
                $image_base64 = base64_decode($image_parts[1]);
                $file = 'product/'.$product_id.'/'.$index. time() . '.png';
                // store image in storage public folder
                Storage::disk('public')->put($file, $image_base64);
                $product->images()->create([
                    'image' => $file
                ]);
            }
        }




    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
