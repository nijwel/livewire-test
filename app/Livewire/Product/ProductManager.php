<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductManager extends Component {
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $view             = 'list'; // 'list' | 'create' | 'edit'
    public $search           = '';
    public $confirmingDelete = false;
    public $deleteId         = null;
    public $perPage          = 5;

    public $product_id, $name, $price, $quantity, $description, $image, $newImage;

    protected $rules = [
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric',
        'quantity'    => 'required|numeric',
        'description' => 'nullable|string',
        'newImage'    => 'nullable|image|max:2048',
    ];

    public function render() {
        $products = Product::where( 'name', 'like', '%' . $this->search . '%' )
            ->orWhere( 'description', 'like', '%' . $this->search . '%' )
            ->latest()
            ->paginate( $this->perPage );

        return view( 'livewire.product.product-manager', compact( 'products' ) );
    }

    public function resetForm() {
        $this->product_id  = null;
        $this->name        = '';
        $this->price       = '';
        $this->quantity    = '';
        $this->description = '';
        $this->image       = '';
        $this->newImage    = null;
    }

    public function changeView( $view, $id = null ) {
        $this->resetForm();

        if ( $view == 'edit' && $id ) {
            $product           = Product::findOrFail( $id );
            $this->product_id  = $product->id;
            $this->name        = $product->name;
            $this->price       = $product->price;
            $this->quantity    = $product->quantity;
            $this->description = $product->description;
            $this->image       = $product->image;
        }

        $this->view = $view;
    }

    public function store() {
        $this->validate();

        $path = $this->newImage ? $this->newImage->store( 'products', 'public' ) : null;

        Product::create( [
            'name'        => $this->name,
            'price'       => $this->price,
            'quantity'    => $this->quantity,
            'description' => $this->description,
            'image'       => $path,
        ] );

        session()->flash( 'message', 'Product created successfully!' );
        $this->resetForm();
        $this->view = 'list';
    }

    public function update() {
        $this->validate();

        $product = Product::findOrFail( $this->product_id );

        $path = $this->newImage ? $this->newImage->store( 'products', 'public' ) : $product->image;

        $product->update( [
            'name'        => $this->name,
            'price'       => $this->price,
            'quantity'    => $this->quantity,
            'description' => $this->description,
            'image'       => $path,
        ] );

        session()->flash( 'message', 'Product updated successfully!' );
        $this->resetForm();
        $this->view = 'list';
    }

    public function confirmDelete( $id ) {
        $this->confirmingDelete = true;
        $this->deleteId         = $id;
    }

    public function delete() {
        Product::findOrFail( $this->deleteId )->delete();
        session()->flash( 'message', 'Product deleted successfully!' );
        $this->confirmingDelete = false;
        $this->deleteId         = null;
    }
}
