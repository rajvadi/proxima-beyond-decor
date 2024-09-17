<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $category = $request->cid;
        $pcodes = $request->pcode;
        $products = Product::where(function($query) use ($pcodes) {
            $query->where('code', 'like', '%' . $pcodes . '%')
                ->orWhere('name', 'like', '%' . $pcodes . '%');
        });
        if ($category) {
            $products = $products->where('category_id', $category);
        }
        $products = $products->latest() // This orders by `created_at` in descending order
            ->limit(50)
            ->get();

        return view('frontend.product.search', compact('products'));

    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $attributes = ProductAttribute::with('attributeValues')->where('product_id',$product->id)->get();
        return view('frontend.product.show', compact('product', 'attributes'));
    }
}
