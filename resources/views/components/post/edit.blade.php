<h3>Edit Product</h3>
{{-- <form wire:submit.prevent="update">
    <input type="text" wire:model="name" class="form-control mb-2" placeholder="Name">
    <input type="number" wire:model="price" class="form-control mb-2" placeholder="Price">
    <input type="number" wire:model="quantity" class="form-control mb-2" placeholder="Quantity">
    <textarea wire:model="description" class="form-control mb-2" placeholder="Description"></textarea>
    <input type="file" wire:model="newImage" class="form-control mb-2">

    @if ($image && !$image instanceof \Livewire\TemporaryUploadedFile)
        <img src="{{ asset('storage/' . $image) }}" width="100" class="mb-2">
    @endif
    <br>
    <button type="submit" class="btn btn-success">Update</button>
    <button type="button" class="btn btn-secondary" wire:click="changeView('list')">Back</button>
</form> --}}

<form wire:submit.prevent="postUpdate">
    <div class="row">
        <div class="form-group col-lg-6 mt-3">
            <label for="name">Title</label>
            <input type="text" class="form-control" id="name" placeholder="Enter title" wire:model="name">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-lg-6 mt-3">
            <label for="category">Category</label>
            <select name="category_id" class="form-control" id="category_id" wire:model="category_id">
                <option value="">Select</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-lg-6 mt-3">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" placeholder="Enter price" wire:model="price">
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-lg-6 mt-3">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity"
                wire:model="quantity">
            @error('quantity')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group mt-3 row">
        <div class="col-md-10">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" wire:model="newImage">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div wire:loading wire:target="image">Uploading...</div>
        </div>
        <div class="col-md-2">
            @if ($image)
                <img src="{{ asset('storage/' . $image) }}" alt="Image Preview" width="100" class="mb-2 mt-4">
            @endif
        </div>
    </div>
    <div class="form-group mt-3">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="3" wire:model="description"></textarea>
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="button" class="btn btn-sm btn-primary mt-3" wire:click="postUpdate">Save</button>
    <button type="button" class="btn btn-sm btn-secondary mt-3" wire:click="changeView('list')">Back</button>
</form>
