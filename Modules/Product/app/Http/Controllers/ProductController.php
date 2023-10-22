<?php

namespace Modules\Product\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\app\Models\Product;

class ProductController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:products.index'])->only('index');
        $this->middleware(['permission:products.show'])->only('show');
        $this->middleware(['permission:products.create'])->only('create', 'store');
        $this->middleware(['permission:products.edit'])->only('edit', 'update');
        $this->middleware(['permission:products.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $this->data['head']['title'] = 'product';

        return response(view('product::index', $this->data));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $this->data['head']['title'] = 'Create product';

        return response(view('product::create', $this->data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        session()->flash('status', 'Record created successfully.');

        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Response
    {
        $this->data['head']['title'] = '';

        $this->data['product'] = $product;

        return response(view('product::show', $this->data));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): Response
    {
        $this->data['head']['title'] = '';

        $this->data['product'] = $product;

        return response(view('product::edit', $this->data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        //
        session()->flash('status', 'Record updated successfully.');

        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        //
        session()->flash('status', 'Record deleted successfully.');

        return redirect(route('product.index'));
    }
}
