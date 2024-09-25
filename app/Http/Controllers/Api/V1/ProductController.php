<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\GroupStoreProductRequest;
use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Requests\V1\UpdateProductRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr as SupportArr;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        $filter = new ProductFilter();

        $filterItems = $filter->transform($request);

        $products = Product::where($filterItems);

        return new ProductCollection($products->paginate()->appends($request->query()));
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        return new ProductResource(Product::create($request->all()));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
    }

    public function destroy(Product $product)
    {
        return $product->delete();
    }

    public function groupStore(GroupStoreProductRequest $request)
    {

        $group = collect($request->all())->map(function($arr, $key) {
            $data = SupportArr::except($arr, ['stockQuantity']);
    
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
    
            return $data;
        });

        Product::insert($group->toArray());
    }

}
