<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductDetailsResource;
use App\Http\Resources\Product\ProductListResource;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'brand_id' => 'nullable|numeric',
            'size_id' => 'nullable|numeric',
        ]);

        if ($validation->fails()) {
            $response = [
                'status' => false,
                'message' => 'Validation Errors',
                'error_code' => true,
                'error_message' => $validation->errors(),
                'current_page' => 0,
                'total_pages' => 0,
                'has_more_pages' => 0,
                'total_data' => 0,
                'data' => [],
            ];
            return response()->json($response, 200);
        }

        $brand_id = $request->input('brand_id');
        $size_id = $request->input('size_id');

        $products = ProductSize::where('product_sizes.status',1)
        ->leftJoin('products','products.id','=','product_sizes.id')
        ->where('products.status',1)
        ->select('product_sizes.*');

        if (!empty($brand_id)) {
            $products->where('products.brand_id',$brand_id);
        }
        if (!empty($size_id)) {
            $products->where('product_sizes.size_id',$size_id);
        }

        $products = $products->orderBy('product_sizes.size_id')->paginate(12);

        $response = [
            'status' => true,
            'message' => 'Product Details',
            'error_code' => true,
            'error_message' => null,
            'current_page' => $products->currentPage(),
            'total_pages' => $products->lastPage(),
            'has_more_pages' => $products->hasMorePages(),
            'total_data' => $products->total(),
            'data' => ProductListResource::collection($products),
        ];
        return response()->json($response, 200);
    }

    public function details($product_size_id)
    {
        $products = ProductSize::where('product_sizes.id',$product_size_id)
        ->select('product_sizes.*')->first();
        $response = [
            'status' => true,
            'message' => 'Product Details',
            'data' => new ProductDetailsResource($products),
        ];
        return response()->json($response, 200);
    }
}
