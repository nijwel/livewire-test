<h2>Create Category</h2>
@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<form wire:submit.prevent="update">
    <div class="form-group mt-3">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" wire:model="name">
        @error('name')
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
    <button type="submit" class="btn btn-sm btn-primary mt-3">Save</button>
    <button type="button" class="btn btn-sm btn-secondary mt-3" wire:click="changeView('list')">Cancel</button>
</form>
