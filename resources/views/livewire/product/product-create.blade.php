<div>
    <h2>Create Product</h2>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit.prevent="save">
        <div class="form-group mt-3">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter product name" wire:model="name">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" placeholder="Enter price" wire:model="price">
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity"
                wire:model="quantity">
            @error('quantity')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-3 row">
            <div class="col-md-10">
                <label for="image">Product Image</label>
                <input type="file" class="form-control" id="image" wire:model="image">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div wire:loading wire:target="image">Uploading...</div>
            </div>
            <div class="col-md-2">
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="img-fluid mt-2" alt="Image Preview" width="100">
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
        <button type="button" class="btn btn-sm btn-primary mt-3" wire:click="save">Save Product</button>
    </form>
</div>
