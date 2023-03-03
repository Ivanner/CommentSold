<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    const PAGE_SIZE = 10;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentPage = request()->input('page', 1) - 1;
        $products = Product::orderBy('id', 'DESC')
            ->sortable()
            ->where('admin_id', Auth::id())
            ->paginate(self::PAGE_SIZE);
        return view('products.index',compact('products'))
            ->with('i', $currentPage * self::PAGE_SIZE);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        // Retrieve the validated input data...
        $input = $request->validated();
        $input['admin_id'] = Auth::id();
        Product::create($input);

        return redirect()->route('products.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     * @param Product $product
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Product  $product
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * @param ProductRequest $request
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }

    private function setAdminId(array $input) {
        $input['admin_id'] = Auth::id();
        return $input;
    }
}
