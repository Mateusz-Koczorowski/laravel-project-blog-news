<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Subscription;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate(10, ['*'], 'users_page');
        $articles = Article::paginate(10, ['*'], 'articles_page');
        $subscriptions = Subscription::paginate(10, ['*'], 'subscriptions_page');
    
        return view('admin.dashboard', compact('users', 'articles', 'subscriptions'));
    }

    public function create()
    {
        return view('admin.create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,Author,Reader',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:Admin,Author,Reader',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }

    // --- Article CRUD for Admin ---
    public function createArticle()
    {
        return view('admin.create-article');
    }

    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'free_content' => 'nullable|string',
            'premium_content' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $imageFileName = null;

        if ($request->hasFile('image_file')) {
            $imageFileName = $request->file('image_file')->store('articles', 'public');
        }

        Article::create([
            'title' => $validated['title'],
            'release_date' => now(),
            'free_content' => $validated['free_content'],
            'premium_content' => $validated['premium_content'],
            'author_id' => auth()->id(),
            'image_file_name' => $imageFileName,
            'alt_text' => $validated['alt_text'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Article created successfully.');
    }

    public function editArticle(Article $article)
    {
        return view('admin.edit-article', compact('article'));
    }

    public function updateArticle(Request $request, Article $article)
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

        return redirect()->route('admin.dashboard')->with('success', 'Article updated successfully.');
    }

    public function destroyArticle(Article $article)
    {
        if ($article->image_file_name) {
            Storage::disk('public')->delete($article->image_file_name);
        }

        $article->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Article deleted successfully.');
    }

    // Approve a subscription
    public function approveSubscription(Subscription $subscription)
    {
        $subscription->update(['status' => 'approved']);

        return redirect()->route('admin.dashboard')->with('success', 'Subscription approved successfully.');
    }

    // Reject a subscription
    public function rejectSubscription(Subscription $subscription)
    {
        $subscription->update(['status' => 'rejected']);

        return redirect()->route('admin.dashboard')->with('success', 'Subscription rejected successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
}
