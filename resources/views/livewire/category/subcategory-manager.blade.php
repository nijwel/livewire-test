<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if ($view == 'list')
        <x-subcategory.index :subcategories="$subcategories" />
    @elseif($view == 'create')
        <x-subcategory.create :categories="$categories" />
    @elseif($view == 'edit')
        <x-subcategory.edit :categories="$categories" />
    @endif

    <x-confirmation-modal :confirmingDelete="$confirmingDelete" />
</div>
