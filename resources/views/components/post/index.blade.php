<div class="d-flex justify-content-between mb-2">
    <h3>Post List</h3>
    <select name="per_page" class="form-control w-25" wire:model.live="perPage">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
    </select>
    <select name="category_id" class="form-control w-25" wire:model.live="category_id">
        <option value="">All</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <input type="search" class="form-control w-25" placeholder="Search..." wire:model.live.debounce.500ms="search">
    <button class="btn btn-sm btn-primary mb-2 float-end" wire:click="changeView('create')">+ Create Post</button>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Description</th>
            <th width="150">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $key => $post)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $post->name }}</td>
                <td>{{ $post->category?->name }}</td>
                <td>{{ $post->price }}</td>
                <td>{{ $post->quantity }}</td>
                <td>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" width="50">
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $post->description }}</td>
                <td>
                    <button class="btn btn-sm btn-warning"
                        wire:click="changeView('edit', {{ $post->id }})">Edit</button>
                    <button class="btn btn-sm btn-danger"
                        wire:click="confirmDelete({{ $post->id }})">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $posts->links() }}
