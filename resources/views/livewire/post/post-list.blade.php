<div>
    <h3>Post List</h3>
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
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->price }}</td>
                    <td>{{ $post->quantity }}</td>
                    <td>
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->name }}" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $post->description }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $post->id }})">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $post->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
