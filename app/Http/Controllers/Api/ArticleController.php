<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\PaginationResource;

class ArticleController extends Controller
{
    protected string $resource = ArticleResource::class;

    public function index(Request $request)
    {
        $articles = Article::when($request->search, fn ($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->tag, fn ($q) => $q->withTag($request->tag))
            ->latest()
            ->paginate(15);

        return successResponse(($this->resource)::collection($articles), message: 'Articles retrieved successfully', pagination: PaginationResource::make($articles));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
        ]);

        // Store also tags in observer article model
        $article = Article::create($validated);

        return successResponse(($this->resource)::make($article), message: 'Article created successfully');
    }

    public function show(Article $article)
    {
        return successResponse(($this->resource)::make($article), message: 'Article retrieved successfully');
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
        ]);

        $article->update($validated);

        return successResponse(($this->resource)::make($article), message: 'Article updated successfully');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return successResponse(message: 'Article deleted successfully');
    }
}
