<?php

namespace Modules\Product\app\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\app\Models\Product;
use Modules\Product\app\Models\Variant;

class VariantController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:products.variants.index'])->only('index');
        $this->middleware(['permission:products.variants.show'])->only('show');
        $this->middleware(['permission:products.variants.create'])->only('create', 'store');
        $this->middleware(['permission:products.variants.edit'])->only('edit', 'update');
        $this->middleware(['permission:products.variants.delete'])->only('destroy');
    }

    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index(Product $product): Response
    // {
    //     $this->data['head']['title'] = '';
    //     $this->data['product'] = $product;

    //     return response(view('product::office.variant.index', $this->data));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $this->data['head']['title'] = '';

        return response(view('product::office.variant.create', $this->data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        session()->flash('status', 'Record created successfully.');

        return redirect(route('dashboard'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Variant $variant): Response
    {
        $this->data['head']['title'] = '';
        $this->data['variant'] = $variant;

        return response(view('product::office.variant.show', $this->data));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): Response
    {
        $this->data['head']['title'] = '';

        return response(view('product::office.variant.edit', $this->data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        //
        session()->flash('status', 'Record updated successfully.');

        return redirect(route('dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        //
        session()->flash('status', 'Record deleted successfully.');

        return redirect(route('dashboard'));
    }
}
