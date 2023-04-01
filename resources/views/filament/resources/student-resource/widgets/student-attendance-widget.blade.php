<x-filament::widget>
    <x-filament::card>
        <h2>{{ $record->name }} {{ $count }}</h2>
        <p><strong>Attendance: </strong> 78%</p>
        <button class="rounded border px-4 py-2" wire:click="incrementCount">Add</button>
    </x-filament::card>
</x-filament::widget>
