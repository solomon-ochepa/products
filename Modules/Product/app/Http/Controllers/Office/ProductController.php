<?php

namespace Modules\Product\app\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\app\Http\Requests\StoreProductRequest;
use Modules\Product\app\Models\Product;
use Modules\Product\app\Models\Variant;
use Modules\User\app\Models\User;

class ProductController extends Controller
{
    public array $data;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:product.index'])->only('index');
        $this->middleware(['permission:product.show'])->only('show');
        $this->middleware(['permission:product.create'])->only('create', 'store');
        $this->middleware(['permission:product.edit'])->only('edit', 'update');
        $this->middleware(['permission:product.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['head']['title'] = 'Global Products';
        $this->data['user'] = User::find(auth()->id());
        $this->data['business'] = $this->data['user']->business;

        return view('product::office.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['head']['title'] = 'Add Product';
        $this->data['user'] = auth()->user();

        return view('product::office.create', $this->data);
    }

    /**
     * Show the form for copying a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function copy(Product $product)
    {
        $this->data['title'] = 'Copy Product';
        $this->data['user'] = auth()->user();
        $this->data['product'] = $product;

        return view('product::office.copy', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::firstOrCreate([
            'name' => $request->product['name'],
            'subtitle' => $request->product['subtitle'],
            'brand_id' => $request->product['brand_id'],
            'manufacturer_id' => $request->product['manufacturer_id'],
        ], $request->product);

        session()->flash('status', 'Product added successfully.');

        return redirect(route('office.product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        // Product Variants
        if (! $product->variants->count()) {
            $product->variants()->create();
            $product->refresh();
        }

        $this->data['user'] = auth()->user();
        // $this->data['variant'] = $request->filled('variant') ? Variant::find($request->query('variant')) : $product->variants->first();
        $this->data['product'] = $product;

        return response(view('product::office.show', $this->data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $user = auth()->user();

        return view('product.office.edit', [
            'user' => $user,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
