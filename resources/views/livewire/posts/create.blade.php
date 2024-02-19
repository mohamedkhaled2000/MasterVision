<?php

use App\Models\Post;
use Mary\Traits\Toast;
use function Livewire\Volt\{state, rules};

$post = null;
if (request('post')) {
    $post = Post::find(request('post'));
}

state([
    'title' => $post?->title ?? '',
    'content' => $post?->content ?? '',
    'id' => $post?->id ?? ''
]);

rules([
    'title' => 'required|min:6',
    'content' => 'required|min:6',
]);

$create = function () {
    $this->validate();
    Post::create([
        'title' => $this->title,
        'content' => $this->content,
    ]);
    return $this->redirect(route('posts'), true);
};

$update = function () {
    $this->validate();

    Post::find($this->id)->update([
        'title' => $this->title,
        'content' => $this->content,
    ]);
    return $this->redirect(route('posts'), true);
};

?>

<div>
    <x-header title="Create post" />

    <x-card>
        <x-form wire:submit="{{ request('post') ? 'update' : 'create' }}">
            <x-input label="Title" wire:model="title" />
            <x-textarea label="Content" wire:model="content" />

            <x-slot:actions>
                <x-button label="Confirm" class="btn-primary" type="submit" spinner="create" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
