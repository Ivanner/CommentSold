@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
            <form class="form-inline" method="GET">
                <div class="form-group mb-2">
                    <label for="filter" class="col-sm-2 col-form-label">Filter</label>
                    <input type="text" class="form-control" id="filter" name="filter" placeholder="Inventory ID or SKU" value="{{$filter}}">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Filter</button>
            </form>
        <table class="table table-bordered mt-3">
            <tr>
                <th>@sortablelink('inventories.id')</th>
                <th>@sortablelink('product.product_name', 'Product Name')</th>
                <th>SKU</th>
                <th>Quantity</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
                <th>Cost</th>
            </tr>
            @foreach ($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->id }}</td>
                    <td>{{ $inventory->product->product_name }}</td>
                    <td>{{ $inventory->sku }}</td>
                    <td>{{ $inventory->quantity }}</td>
                    <td>{{ $inventory->color }}</td>
                    <td>{{ $inventory->size }}</td>
                    <td>${{ number_format($inventory->price_cents * 100, 2) }}</td>
                    <td>${{ number_format($inventory->cost_cents * 100, 2) }}</td>
                </tr>
            @endforeach
        </table>

        {!! $inventories->withQueryString()->links() !!}
        <p>
            Displaying {{$inventories->count()}} of {{ $inventories->total() }} product(s).
        </p>
    </div>
@endsection
