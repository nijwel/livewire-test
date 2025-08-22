<div class="d-flex justify-content-between mb-2">
    <h3>Product List</h3>
    <select name="per_page" class="form-control w-25" wire:model.live="perPage">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
    </select>
    <input type="text" class="form-control w-25" placeholder="Search..." wire:model.live.debounce.500ms="search">
    <button class="btn btn-sm btn-primary mb-2 float-end" wire:click="changeView('create')">+ Create Product</button>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key => $product)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="50">
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $product->description }}</td>
                <td>
                    <button class="btn btn-sm btn-warning"
                        wire:click="changeView('edit', {{ $product->id }})">Edit</button>
                    <button class="btn btn-sm btn-danger"
                        wire:click="confirmDelete({{ $product->id }})">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $products->links() }}
