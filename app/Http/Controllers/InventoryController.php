<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{

    const PAGE_SIZE = 10;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter = request()->query('filter');
        $currentPage = request()->input('page', 1) - 1;
        $query = Inventory::whereRelation('product', 'admin_id', Auth::id())->sortable();
        if (empty($filter)) {
            $inventories = $query->paginate(self::PAGE_SIZE);
        } else {
            $inventories = $query
                ->where('inventories.id', 'LIKE', "%$filter%")
                ->orWhere('sku', 'LIKE', "%$filter%")
                ->paginate(self::PAGE_SIZE);
        }
        return view('inventory.index',compact('inventories', 'filter'))
            ->with('i', $currentPage * self::PAGE_SIZE);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
