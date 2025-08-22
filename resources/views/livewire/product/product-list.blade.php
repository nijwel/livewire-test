<div>
    <h3>Product List</h3>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $product->id }})">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $product->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
