<div>
    <input type="text" wire:model.live.lazy="data.name" />

    <br><br><br>

    <h2>{{ $name }}</h2>

    <ul>
        @foreach ($data as $n)
            <li>{{ $n }}</li>
        @endforeach
    </ul>

    <div>
        <button wire:click="decrement">-</button>
        <span>{{ $count }}</span>
        <button wire:click="increment">+</button>
    </div>

</div>
