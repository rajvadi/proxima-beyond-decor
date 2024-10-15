<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
use Barryvdh\DomPDF\Facade\Pdf;
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
            // Get all products DESC order by id
            $products = Product::query();
            $category_id = request()->get('category_id');
            if ($category_id) {
                $products->where('category_id', $category_id);
            }
            $products = $products->latest();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('category', function ($product) {
                    return $product->category->name;
                })
                ->editColumn('image', function ($product) {
                    // Get the first image of the product if available
                    $image = $product->images->first();
                    if ($image) {
                        return '<img src="'.$image->image_url.'" style="object-fit: contain;" width="100px" height="100px">';
                    }
                })->addColumn('actions', function ($product) {
                    return
                        ' 
                                <a title="View Product" style="font-size:22px;" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalLong" class="view-link" data-remote="' . route('admin.product.show', ['product' => $product->id]) . '"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                <a title="Print Product" target="_blank" style="font-size:22px;" href="'. route('admin.product.printA4',['product' => $product->id]).'" class="print-link"><i class="fas fa-print"></i></a>&nbsp;&nbsp;
                                 <a href="javascrip:void(0);" class="basic-info" title="Edit Product Info" data-bs-toggle="modal" data-bs-target="#editproductinfo" style="font-size:22px;" data-remote="' . route('admin.product.edit', ['product' => $product->id]) . '"><i class="fas fa-file-signature"></i></a>&nbsp;&nbsp;
                                 <a href="javascrip:void(0);" class="attribute-info" title="Edit Product Attribute" data-bs-toggle="modal" data-bs-target="#editproductattr" style="font-size:22px;" data-remote="' . route('admin.product.attribute', ['product' => $product->id]) . '"><i class="far fa-money-bill-alt"></i></a>&nbsp;&nbsp;
                                 <a href="javascrip:void(0);" class="image-info" title="Edit Product Image" data-bs-toggle="modal" data-bs-target="#editproductimg" style="font-size:22px;" data-remote="' . route('admin.product.image', ['product' => $product->id]) . '"><i class="fas fa-images"></i></a>&nbsp;&nbsp;
                                <a title="Delete Product" style="font-size:21px;" class="delete-link" data-remote="' . route('admin.product.destroy', ['product' => $product->id]) . '"  href="#"><i class="fa fa-trash" style="color: red"></i></a>
                                ';
                })->rawColumns(['image','actions'])->make(true);
        }
        $categories = Category::all();
        return view('admin.product.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = Attribute::all();
        $categories = Category::all();
        return view('admin.product.create', compact('attributes', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'code' => 'required',
            'description' => 'nullable',
            'material' => 'nullable',
            'price_per' => 'nullable|in:piece,set,none',
            'MRP' => 'nullable',
            'product_images' => 'array',
            'product_images.*' => 'string',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->code = $request->code;
        $product->description = $request->description;
        $product->material = $request->material;
        $product->price_per = $request->price_per;
        $product->MRP = $request->MRP;
        if ($product->save()) {
            $product_id = $product->id;
            $attributes = $request->get('attributes');
            $values = $request->get('values');
            $available_values = $request->get('availables');
            if (isset($attributes) && $attributes[0]['name'] != '') {
                foreach ($attributes as $index => $attributeData) {
                    // Create or find the attribute
                    $attribute = Attribute::firstOrCreate(['name' => $attributeData['name']]);

                    // Link the product to the attribute
                    $productAttribute = ProductAttribute::create([
                        'product_id' => $product->id,
                        'attribute_id' => $attribute->id,
                    ]);

                    // Loop through the values to create the attribute values
                    foreach ($values as $key => $value) {
                        // Save each attribute value
                        AttributeValue::create([
                            'product_attribute_id' => $productAttribute->id,
                            'value' => $value[$index],
                            'is_available' => isset($available_values[$key][$index]) ? 1 : 0,
                        ]);
                    }
                }
            }

            // upload base64 images
            $images = $request->get('product_images');
            if (isset($images) && $images != '') {
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

            return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
        } else {
            return redirect()->route('admin.product.index')->with('error', 'Product creation failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        /*echo '<pre>';
        print_r($product->attributeValues); die;*/
        // Fetch all product attributes with their values
        $attributes = ProductAttribute::with('attributeValues')->where('product_id',$product->id)->get();
        $html = view('admin.product.show',compact('product','attributes'))->render();
        return response()->json(['success' => true,'html'=>$html]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $html = view('admin.product.edit-basic',compact('product','categories'))->render();
        return response()->json(['success' => true,'html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|unique:products,code,'.$product->id,
            'description' => 'nullable',
            'material' => 'nullable',
        ]);

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->code = $request->code;
        $product->description = $request->description;
        $product->material = $request->material;
        $product->MRP = $request->MRP;
        if ($product->save()) {
            return response()->json(['success' => true,'message'=>'Product updated successfully']);
        } else {
            return response()->json(['success' => false,'message'=>'Product update failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (request()->ajax()) {
            if ($product->delete()) {
                // delete product image folder from storage
                if(Storage::exists('public/product/'.$product->id)){
                    Storage::deleteDirectory('public/product/'.$product->id);
                }
                $response['success'] = true;
                $response['message'] = 'Product successfully deleted';
                return response()->json($response, 200);
            } else {
                $response['success'] = false;
                $response['message'] = 'Something went wrong!';
                return response()->json($response, 200);
            }
        } else {
            return redirect()->route('admin.product.index')->with('error', 'Something went wrong!');
        }
    }

    public function getAttribute(Request $request,Product $product)
    {
        if(request()->isMethod('post')){
            $attributes = $request->get('attributes');
            $values = $request->get('values');
            $available_values = $request->get('availables');

            // Delete all existing attributes
            ProductAttribute::where('product_id',$product->id)->delete();
            if (isset($attributes) && $attributes[0]['name'] != '') {
                foreach ($attributes as $index => $attributeData) {
                    // Create or find the attribute
                    $attribute = Attribute::firstOrCreate(['name' => $attributeData['name']]);

                    // Link the product to the attribute
                    $productAttribute = ProductAttribute::create([
                        'product_id' => $product->id,
                        'attribute_id' => $attribute->id,
                    ]);

                    // Loop through the values to create the attribute values
                    foreach ($values as $key => $value) {
                        // Save each attribute value
                        AttributeValue::create([
                            'product_attribute_id' => $productAttribute->id,
                            'value' => $value[$index],
                            'is_available' => isset($available_values[$key][$index]) ? 1 : 0,
                        ]);
                    }
                }
            }
            // update price_per field
            $product->price_per = $request->price_per;
            $product->save();
            return response()->json(['success' => true,'message'=>'Product attributes updated successfully']);
        }
        $attributes = ProductAttribute::with('attributeValues')->where('product_id',$product->id)->get();
        $html = view('admin.product.attribute',compact('product','attributes'))->render();
        return response()->json(['success' => true,'html'=>$html]);
    }

    public function getImage(Request $request,Product $product)
    {
        if(request()->isMethod('post')){
            $old_images_id = $request->get('old_images');
            $images = $request->get('product_images');
            if($old_images_id){
                $product->images()->wherenotIn('id',$old_images_id)->delete();
            }
            if ($images) {
                foreach ($images as $index => $image) {
                    $image_parts = explode(";base64,", $image);
                    $image_base64 = base64_decode($image_parts[1]);
                    $file = 'product/' . $product->id . '/' . $index . time() . '.png';
                    // store image in storage public folder
                    Storage::disk('public')->put($file, $image_base64);
                    $product->images()->create([
                        'image' => $file
                    ]);
                }
            }
            return response()->json(['success' => true,'message'=>'Product images updated successfully']);
        }
        $html = view('admin.product.image',compact('product'))->render();
        return response()->json(['success' => true,'html'=>$html]);
    }

    public function printA4(Product $product)
    {
        $data = ['title' => 'A4 Size product page','product' => $product]; // Pass any data to your view
        $pdf = PDF::loadView('admin.product.print', $data)
            ->setPaper('a4', 'portrait'); // Set the paper size to A4 and orientation to portrait

        return $pdf->stream('document.pdf'); // Stream the PDF in the browser
    }

    public function printProductCode(Request $request)
    {
        if (request()->isMethod('post')) {
            $products = $request->product;
            $qty = $request->qty;
            $isNamePrint = $request->is_product_name;

            $productData = [];
            foreach ($products as $key => $product) {
                $product = Product::find($product);
                $product->qty = $qty[$key];
                $product->is_name_print = isset($isNamePrint[$key]) ? $isNamePrint[$key] : 0;
                $productData[] = $product;
            }
            $data = ['title' => 'A4 Size product page','products' => $productData]; // Pass any data to your view
            $pdf = PDF::loadView('admin.product.print', $data)
                ->setPaper('a4', 'portrait'); // Set the paper size to A4 and orientation to portrait

            return $pdf->stream('document.pdf'); // Stream the PDF in the browser
        }
        $products = Product::all();
        return view('admin.product.print-code',compact('products'));
    }
}
