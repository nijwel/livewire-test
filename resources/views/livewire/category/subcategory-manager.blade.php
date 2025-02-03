<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if ($view == 'list')
        <x-subcategory.index :categories="$categories" />
    @elseif($view == 'create')
        <x-subcategory.create />
    @elseif($view == 'edit')
        <x-subcategory.edit />
    @endif

    <x-confirmation-modal :confirmingDelete="$confirmingDelete" />
</div>
