<?php

namespace App\Livewire;

use Mary\Traits\Toast;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post as PostModel;

class Post extends Component
{
    use Toast;
    use WithPagination;

    public bool $deleteModal = false;
    public bool $myModal = false;
    public int $id;
    public string $formAction = 'savePost';
    public array $sortBy = [
        'column' => 'id', 'direction' => 'desc',
        'column' => 'title', 'direction' => 'desc',
        'column' => 'content', 'direction' => 'desc',
    ];

    public $selected = [];

    public array $form = [
        'title' => '',
        'content' => '',
    ];

    public function render()
    {
        return view('livewire.posts', [
            'posts' => PostModel::orderBy(...array_values($this->sortBy))
                ->paginate(10),
        ]);
    }


    public function savePost()
    {
        $this->validate([
            'form.title' => 'required',
            'form.content' => 'required',
        ]);

        PostModel::create($this->form);

        $this->success('Post created successfully');
        $this->myModal = false;
        // Save the post
        $this->reset('form');
    }

    public function edit()
    {
        $this->formAction = 'updatePost';
        $post = PostModel::findOrFail($this->id);
        $this->form = $post->toArray();
        $this->myModal = true;
    }

    public function updatePost()
    {
        $this->validate([
            'form.title' => 'required',
            'form.content' => 'required',
        ]);

        PostModel::findOrFail($this->id)->update($this->form);

        $this->success('Post updated successfully');
        $this->myModal = false;
        // Save the post
        $this->reset('form', 'id', 'formAction');
    }

    public function delete()
    {
        PostModel::findOrFail($this->id)->delete();
        $this->deleteModal = false;
        $this->success('Post deleted successfully');
    }
}
