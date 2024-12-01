<div class="d-flex justify-content-between mb-2">
    <h3>Category List</h3>
    <select name="per_page" class="form-control w-25" wire:model.live="perPage">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="200">200</option>
    </select>
    <input type="search" class="form-control form-control-sm w-25" placeholder="Search..."
        wire:model.live.debounce.500ms="search">
    <a href="/subcategory" class="btn btn-sm btn-info mb-2">Subcategory</a>
    <button class="btn btn-sm btn-primary mb-2 float-end" wire:click="changeView('create')">+ Create New</button>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col" width="50">#</th>
            <th>Name</th>
            <th>Status</th>
            <th width="150">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $key => $category)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $category->name }}</td>
                <td><span class=" badge @if ($category->status == 'active') bg-success @else bg-danger @endif"
                        role="button" wire:click="changeStatus({{ $category->id }})">{{ $category->status }}</span>
                </td>
                <td>
                    <button class="btn
                        btn-sm btn-warning"
                        wire:click="changeView('edit', {{ $category->id }})">Edit</button>
                    <button class="btn btn-sm btn-danger"
                        wire:click="confirmDelete({{ $category->id }})">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $categories->links() }}
