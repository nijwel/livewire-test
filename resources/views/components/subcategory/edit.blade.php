<div class="card w-50 mx-auto">
    <div class="card-header d-flex justify-content-between content-center">
        <h2>Edit Subcategory</h2>
        <button type="button" class="btn btn-sm btn-primary mt-3" wire:click="changeView('list')">Back</button>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="subcategoryUpdate">
            <div class="form-group mt-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" wire:model="name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="category">Category</label>
                <select name="parent_id" class="form-control" id="parent_id" wire:model="parent_id">
                    <option value="">Select</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('parent_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="status">Status</label>
                <select class="form-control" id="status" wire:model.live="status">
                    <option value="">Select status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="button" class="btn btn-sm btn-primary mt-3" wire:click="subcategoryUpdate">Update</button>
            <button type="button" class="btn btn-sm btn-secondary mt-3" wire:click="changeView('list')">Cancel</button>
        </form>
    </div>
</div>
