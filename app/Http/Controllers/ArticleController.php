<?php

namespace App\Http\Controllers;
use App\Http\Requests\ArticleUpdateRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function single(Article $article)
    {
        $article->view_count = $article->view_count + 1;

        $article->save();

        return view('single', compact('article'));
    }

    public function delete(Article $article)
    {
        $article->delete();

        return redirect()->route('home');
    }

    public function store(ArticleStoreRequest $request)
    {
        $validated = $request->validated();

        if ($request->file('photo')) {
            $validated['image_path'] = $request->file('photo')->store('public/images');
        }

        $validated['author_id'] = Auth::user()->getAuthIdentifier();

        $article = Article::query()->create($validated);

        return redirect()->route('article.single', $article->id);
    }

    public function update(Article $article, ArticleUpdateRequest $request)
    {
        $validated = $request->validated();

        if ($request->file('photo')) {
            $validated['image_path'] = $request->file('photo')->store('public/images');
        }

        $article->update($validated);

        return redirect()->route('article.single', $article->id);
    }


    public function createForm()
    {
        return view('articles.create');
    }

    public function updateForm(Article $article)
    {
        return view('articles.update', compact('article'));
    }
}
