<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PaginationResource;

class CommentController extends Controller
{
    protected string $resource = CommentResource::class;

    public function index(Article $article)
    {
        $comments = $article->comments()->latest()->paginate(15);

        return successResponse(($this->resource)::collection($comments), pagination: PaginationResource::make($comments), message: 'Comments retrieved successfully');
    }

    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'comment'   => 'required',
        ]);

        $validated['user_id'] = auth('sanctum')->id();
        $comment = $article->comments()->create($validated);

        return successResponse(($this->resource)::make($comment), message: 'Comment created successfully');
    }

    public function update(Request $request, Article $article, Comment $comment)
    {
        $validated = $request->validate([
            'comment'   => 'required',
        ]);

        $comment->update($validated);

        return successResponse(($this->resource)::make($comment), message: 'Comment updated successfully');
    }

    public function destroy(Article $article, Comment $comment)
    {
        $comment->delete();

        return successResponse(message: 'Comment deleted successfully');
    }
}
