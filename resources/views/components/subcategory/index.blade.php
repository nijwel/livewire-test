<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between mb-2">
            <h3>Subcategory List</h3>
            <select name="per_page" class="form-control w-25" wire:model.live="perPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>
            <input type="search" class="form-control w-25" placeholder="Search..."
                wire:model.live.debounce.500ms="search">
            <a href="/category" class="btn btn-sm btn-info mb-2 float-end">Category</a>
            <button class="btn btn-sm btn-primary mb-2 float-end" wire:click="changeView('create')">+ Create
                New</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $key => $sub)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $sub->name }}</td>
                        <td>{{ $sub->parent?->name }}</td>
                        <td><span class=" badge @if ($sub->status == 'active') bg-success @else bg-danger @endif"
                                role="button" wire:click="changeStatus({{ $sub->id }})">{{ $sub->status }}</span>
                        </td>
                        <td>
                            <button class="btn
                        btn-sm btn-warning"
                                wire:click="changeView('edit', {{ $sub->id }})">Edit</button>
                            <button class="btn btn-sm btn-danger"
                                wire:click="confirmDelete({{ $sub->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $subcategories->links() }}
    </div>
</div>
