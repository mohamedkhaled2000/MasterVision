<div>
    <x-header title="Posts" />

    {{-- Notice `onclick` is HTML --}}
    <x-button label="Open modal" class="btn-primary" link="/posts/create"  />

    {{-- Here is modal`s ID --}}
    {{-- <x-modal wire:model="myModal" title="Create post" separator>
        <x-card>
            <x-form wire:submit="{{ $formAction }}">
                <x-input label="Title" wire:model="form.title" />
                <x-textarea label="Content" wire:model="form.content" />

                <x-slot:actions>
                    <x-button label="Cancel" wire:click="$toggle('myModal')" />
                    <x-button label="Confirm" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </x-modal> --}}

    <x-modal wire:model="deleteModal" title="Delete post" separator>
        Are you sure you want to delete this post?
        <x-slot:actions>
            {{-- Notice `onclick` is HTML --}}
            <x-button label="Cancel" wire:click="$toggle('deleteModal')" />
            <x-button label="Confirm" class="btn-primary" @click="$wire.delete()" spinner />
        </x-slot:actions>
    </x-modal>

    <x-card>
        <x-table :headers="[
            ['key' => 'id', 'label' => 'ID'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'content', 'label' => 'Content'],
        ]" :rows="$posts" with-pagination selectable wire:model="selected" :sort-by="$sortBy">

            @scope('actions', $post)
                <div class="flex">
                    <x-button icon="o-pencil-square" spinner link="/posts/{{ $post->id }}/edit"
                        class="btn-sm" />
                    <x-button icon="o-trash" @click="$wire.deleteModal = true; $wire.id = {{ $post->id }}" spinner
                        class="btn-sm" />
                </div>
            @endscope
        </x-table>
    </x-card>
</div>
