<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SubcategoryManager extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search           = '';
    public $perPage          = 10;
    public $view             = 'list'; // 'list' | 'create' | 'edit'
    public $confirmingDelete = false;
    public $deleteId         = null;

    public $categories = []; // parent categories dropdown

    // form fields
    public $subcategory_id;
    public $parent_id;
    public $name;
    public $slug;
    public $status;

    protected $rules = [
        'name'      => 'required|string|max:255|unique:categories,slug',
        'parent_id' => 'required|exists:categories,id',
        'status'    => 'required|in:active,inactive',
    ];

    protected $messages = [
        'name.unique'        => 'Subcategory name already exists',
        'parent_id.required' => 'Please select a category',
        'status.required'    => 'Please select a status',
    ];

    public function mount() {
        // only load top-level categories for parent selection
        $this->categories = Category::whereStatus( 'active' )
            ->whereNull( 'parent_id' )
            ->get( ['id', 'name'] );
    }

    public function resetForm() {
        $this->subcategory_id = null;
        $this->parent_id      = '';
        $this->name           = '';
        $this->slug           = '';
        $this->status         = '';
    }

    public function changeView( $view, $id = null ) {
        $this->resetForm();

        if ( $view == 'edit' && $id ) {
            $subcategory = Category::findOrFail( $id );

            $this->subcategory_id = $subcategory->id;
            $this->parent_id      = $subcategory->parent_id;
            $this->name           = $subcategory->name;
            $this->slug           = $subcategory->slug;
            $this->status         = $subcategory->status;
        }

        $this->view = $view;
    }

    public function subcategoryStore() {
        $this->validate();

        Category::create( [
            'name'      => $this->name,
            'slug'      => Str::slug( $this->name ),
            'parent_id' => $this->parent_id,
            'status'    => $this->status,
        ] );

        session()->flash( 'message', 'Subcategory created successfully!' );
        $this->resetForm();
        $this->view = 'list';
    }

    public function subcategoryUpdate() {
        $this->validate();

        $subcategory = Category::findOrFail( $this->subcategory_id );

        $subcategory->update( [
            'name'      => $this->name,
            'slug'      => Str::slug( $this->name ),
            'parent_id' => $this->parent_id,
            'status'    => $this->status,
        ] );

        session()->flash( 'message', 'Subcategory updated successfully!' );
        $this->resetForm();
        $this->view = 'list';
    }

    public function changeStatus( $id ) {
        $subcategory         = Category::findOrFail( $id );
        $subcategory->status = $subcategory->status == 'active' ? 'inactive' : 'active';
        $subcategory->save();

        session()->flash( 'message', 'Subcategory ' . $subcategory->status . ' successfully!' );
    }

    public function confirmDelete( $id ) {
        $this->deleteId         = $id;
        $this->confirmingDelete = true;
    }

    public function subcategoryDelete() {
        Category::findOrFail( $this->deleteId )->delete();

        session()->flash( 'message', 'Subcategory deleted successfully!' );
        $this->confirmingDelete = false;
        $this->deleteId         = null;
    }

    public function render() {
        $subcategories = Category::whereNotNull( 'parent_id' )
            ->with( 'parent:id,name' )
            ->where( 'name', 'like', '%' . $this->search . '%' )
            ->latest()
            ->paginate( $this->perPage );

        return view( 'livewire.category.subcategory-manager', compact( 'subcategories' ) );
    }
}
