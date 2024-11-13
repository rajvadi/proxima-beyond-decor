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
        // first search by product by code
        $product = Product::where('code', $pcodes)->first();
        if ($product) {
            return redirect()->route('product.show', $product->id);
        }
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

    public function searchCode (Request $request)
    {
        $keyword = $request->keyword;
        if (!$keyword) {
            return '';
        }
        $category = $request->cid;
        // search product by code
        $products = Product::where('code', 'like', '%' . $keyword . '%');
        if ($category) {
            $products = $products->where('category_id', $category);
        }
        $products = $products->limit(10)->get();

        if ($products->count() > 0) {
            $html = '<ul id="product-list">';
            foreach ($products as $product) {
                $html .= '<li onClick="selectProduct(\'' . $product->code . '\');">' . $product->code . '</li>';
            }
            $html .= '</ul>';
            return $html;
        }

    }
}
