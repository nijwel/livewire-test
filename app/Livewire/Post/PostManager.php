<?php

namespace App\Livewire\Post;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Title( 'Post Manager' )]
class PostManager extends Component {
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $view             = 'list'; // 'list' | 'create' | 'edit'
    public $search           = '';
    public $confirmingDelete = false;
    public $deleteId         = null;
    public $perPage          = 10;

    public $post_id, $name, $price, $quantity, $description, $image, $newImage, $category_id, $categories = [];

    protected $rules = [
        'name'        => 'required|string|max:255',
        'category_id' => 'required|exists:categories',
        'price'       => 'required|numeric',
        'quantity'    => 'required|numeric',
        'description' => 'nullable|string',
        'newImage'    => 'nullable|image|max:2048',
    ];

    public function mount() {
        $this->categories = Category::whereStatus( 'active' )->get( ['id', 'name'] );
    }

    public function render() {
        $posts = Post::where( 'name', 'like', '%' . $this->search . '%' )
            ->orWhere( 'description', 'like', '%' . $this->search . '%' )
            ->latest()
            ->paginate( $this->perPage );

        return view( 'livewire.post.post-manager', compact( 'posts' ) );
    }

    public function resetForm() {
        $this->post_id     = null;
        $this->name        = '';
        $this->price       = '';
        $this->quantity    = '';
        $this->description = '';
        $this->image       = '';
        $this->category_id = '';
        $this->newImage    = null;
    }

    public function changeView( $view, $id = null ) {
        $this->resetForm();

        if ( $view == 'edit' && $id ) {
            $post              = Post::findOrFail( $id );
            $this->post_id     = $post->id;
            $this->name        = $post->name;
            $this->price       = $post->price;
            $this->quantity    = $post->quantity;
            $this->description = $post->description;
            $this->image       = $post->image;
        }

        $this->view = $view;
    }

    public function store() {
        $this->validate();

        $path = $this->newImage ? $this->newImage->store( 'posts', 'public' ) : null;

        Post::create( [
            'name'        => $this->name,
            'price'       => $this->price,
            'quantity'    => $this->quantity,
            'description' => $this->description,
            'image'       => $path,
        ] );

        session()->flash( 'message', 'Post created successfully!' );
        $this->resetForm();
        $this->view = 'list';
    }

    public function update() {
        $this->validate();

        $post = Post::findOrFail( $this->post_id );

        $path = $this->newImage ? $this->newImage->store( 'posts', 'public' ) : $post->image;

        $post->update( [
            'name'        => $this->name,
            'price'       => $this->price,
            'quantity'    => $this->quantity,
            'description' => $this->description,
            'image'       => $path,
        ] );

        session()->flash( 'message', 'Post updated successfully!' );
        $this->resetForm();
        $this->view = 'list';
    }

    public function confirmDelete( $id ) {
        $this->confirmingDelete = true;
        $this->deleteId         = $id;
    }

    public function delete() {
        Post::findOrFail( $this->deleteId )->delete();
        session()->flash( 'message', 'Post deleted successfully!' );
        $this->confirmingDelete = false;
        $this->deleteId         = null;
    }
}
