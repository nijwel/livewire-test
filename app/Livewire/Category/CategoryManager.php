<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title( 'Category Manager' )]
class CategoryManager extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search             = '';
    public $perPage            = 10;
    public $view               = 'list'; // 'list' | 'create' | 'edit'
    public $confirmingDelete   = false;
    public $deleteId           = null;

    public $name, $slug, $status, $category_id;

    protected $rules = [
        'name'   => 'required|string|unique:categories,slug|max:255',
        'slug'   => 'nullable|string|max:255|unique:categories,slug',
        'status' => 'required|in:active,inactive',
    ];

    public function resetForm() {
        $this->category_id = null;
        $this->name        = '';
    }

    public function changeView( $view, $id = null ) {

        $this->resetForm();

        if ( $view == 'edit' && $id ) {
            $category          = Category::findOrFail( $id );
            $this->category_id = $category->id;
            $this->name        = $category->name;
            $this->slug        = $category->slug;
            $this->status      = $category->status;
        }

        $this->view = $view;
    }

    public function store() {
        $this->validate();

        Category::create( [
            'name'   => $this->name,
            'slug'   => Str::slug( $this->name ),
            'status' => $this->status,
        ] );

        session()->flash( 'message', 'Category created successfully!' );
        $this->resetForm();
        $this->view = 'list';
    }

    public function update() {
        $this->validate();

        $category = Category::findOrFail( $this->category_id );

        $category->update( [
            'name'   => $this->name,
            'slug'   => Str::slug( $this->name ),
            'status' => $this->status,
        ] );

        session()->flash( 'message', 'Category updated successfully!' );
        $this->resetForm();
        $this->view = 'list';
    }

    public function confirmDelete( $id ) {
        $this->confirmingDelete = true;
        $this->deleteId         = $id;
    }

    public function delete() {
        Category::findOrFail( $this->deleteId )->delete();
        session()->flash( 'message', 'Category deleted successfully!' );
        $this->confirmingDelete = false;
        $this->deleteId         = null;
    }

    public function mount() {
        $categories = Category::where( 'name', 'like', '%' . $this->search . '%' )
            ->with( 'children:id,name,parent_id' )
            ->orWhere( 'slug', 'like', '%' . $this->search . '%' )
            ->latest()
            ->paginate( $this->perPage );
    }

    public function render() {
        $categories = Category::where( 'name', 'like', '%' . $this->search . '%' )
            ->whereNull( 'parent_id' )
            ->with( 'children:id,name,parent_id' )
            ->orWhere( 'slug', 'like', '%' . $this->search . '%' )
            ->latest()
            ->paginate( $this->perPage );
        return view( 'livewire.category.category-manager', compact( 'categories' ) );
    }
}