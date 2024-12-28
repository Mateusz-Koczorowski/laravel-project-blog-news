<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->with('author')->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'free_content' => 'nullable|string',
            'premium_content' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $imageFileName = $request->hasFile('image_file') 
            ? $request->file('image_file')->store('articles', 'public') 
            : null;

        Article::create([
            'title' => $validated['title'],
            'release_date' => now(),
            'free_content' => $validated['free_content'],
            'premium_content' => $validated['premium_content'],
            'author_id' => auth()->id(),
            'image_file_name' => $imageFileName,
            'alt_text' => $validated['alt_text'],
        ]);

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'free_content' => 'nullable|string',
            'premium_content' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image_file')) {
            if ($article->image_file_name) {
                Storage::disk('public')->delete($article->image_file_name);
            }
            $article->image_file_name = $request->file('image_file')->store('articles', 'public');
        }

        $article->update([
            'title' => $validated['title'],
            'free_content' => $validated['free_content'],
            'premium_content' => $validated['premium_content'],
            'alt_text' => $validated['alt_text'],
        ]);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        if ($article->image_file_name) {
            Storage::disk('public')->delete($article->image_file_name);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

    public function authorDashboard()
    {
        $articles = Article::where('author_id', auth()->id())->paginate(10);
        return view('author.dashboard', compact('articles'));
    }
}
