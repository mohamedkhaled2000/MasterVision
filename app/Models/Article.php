<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    public function scopeWithTag($query, $tag)
    {
        return $query->where('description', 'LIKE', '%#' . $tag . '%');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'article_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function ($article) {
            preg_match_all('/#(\w+)/', $article->description, $matches);

            $article->tags()->createMany(array_map(fn ($tag) => ['name' => $tag], $matches[1]));
        });
    }
}
