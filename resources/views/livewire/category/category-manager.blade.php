<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if ($view == 'list')
        <x-category.index :categories="$categories" />
    @elseif($view == 'create')
        <x-category.create />
    @elseif($view == 'edit')
        <x-category.edit />
    @endif

    <x-confirmation-modal :confirmingDelete="$confirmingDelete" />
</div>
