<?php

namespace Modules\Product\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Product\app\Models\Product;

class ProductController extends Controller
{
    public $data = [];

    public function __construct()
    {
        // $this->middleware('auth:api');
        // $this->middleware(['permission:products.index'])->only('index');
        // $this->middleware(['permission:products.show'])->only('show');
        // $this->middleware(['permission:products.create'])->only('create', 'store');
        // $this->middleware(['permission:products.edit'])->only('edit', 'update');
        // $this->middleware(['permission:products.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->data['data']['products'] = Product::all();

        return response()->json($this->data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        $this->data['product'] = $product;

        return response()->json($this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        return redirect(route('product.index'));
    }
}
