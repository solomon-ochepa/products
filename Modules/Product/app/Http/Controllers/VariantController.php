<?php

namespace Modules\Product\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Modules\Product\app\Models\Variant;

class VariantController extends Controller
{
    public $data = [];

    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware(['permission:product.list'])->only('index');
        // $this->middleware(['permission:product.show'])->only('show');
        // $this->middleware(['permission:product.create'])->only('create', 'store');
        // $this->middleware(['permission:product.edit'])->only('edit', 'update');
        // $this->middleware(['permission:product.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $this->data['head']['title'] = '';

        return response(view('product::variant.index', $this->data));
    }

    /**
     * Display the specified resource.
     */
    public function show(Variant $variant): Response
    {
        $this->data['head']['title'] = '';
        $this->data['variant'] = $variant;

        return response(view('product::variant.show', $this->data));
    }
}
