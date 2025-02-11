<div>

    <!-- Global Livewire Loading Spinner -->
    {{-- <div wire:loading wire:target="store, update, delete"
        style="
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    ">
        <div class="text-center text-white">
            <div class="spinner-border text-light" role="status" style="width:3rem;height:3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="mt-2">Loading...</div>
        </div>
    </div> --}}
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if ($view == 'list')
        <x-post.index :posts="$posts" />
    @elseif($view == 'create')
        <x-post.create :image="$image" :categories="$categories" />
    @elseif($view == 'edit')
        <x-post.edit :image="$image" />
    @endif

    <x-confirmation-modal :confirmingDelete="$confirmingDelete" />
</div>
