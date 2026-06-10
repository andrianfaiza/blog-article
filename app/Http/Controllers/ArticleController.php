<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ArticleController extends Controller
{
    // -------------------Article-----------------
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'header' => 'required|string|max:250',
            'content' => 'required|string',
        ]);
        
        $validated['author_id'] = Auth::id();

        $article = Article::create($validated);

        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard')->with('success', 'Deleted');
        } else {
            return redirect()->route('editor.dashboard')->with('success', 'Deleted');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return redirect()->route('articles.show', $article->id)->with('success', 'Updated');
    }

    public function destroy(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        if ($request->query('from') === 'myarticles') {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->with('success', 'Deleted');
            }

            if (auth()->user()->hasRole('editor')) {
                return redirect()->route('editor.myarticles')->with('success', 'Deleted');
            }
        }

        if ($request->query('from') === 'show') {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->with('success', 'Deleted');
            }

            if (auth()->user()->hasRole('editor')) {
                return redirect()->route('editor.myarticles')->with('success', 'Deleted');
            }
        }
        // return redirect()->back()->with('success', 'Deleted');
    }

    // -----------------------Admin Articles -------------------

    public function indexAdmin()
    {
        $articleCount = Article::where('author_id', Auth::id())->count();
        $articleShow = Article::where('author_id', Auth::id())->latest()->get();
        $articles = Article::latest()->get();
        $articleTotal = Article::count();
        $userTotal = User::count();
        return view('admin.dashboard', compact('articleCount', 'articleShow', 'articles', 'articleTotal', 'userTotal'));
    }

    public function userTable()
    {
        $user = User::all();
        return view('admin.usertable', compact('user'));
    }

    public function adminArtikel()
    {
        $user = auth()->user();
        $articleCount = Article::where('author_id', Auth::id())->count();
        $articles = Article::where('author_id', $user->id)->latest()->get();
        return view('articles.myarticles', compact('articles', 'articleCount'));
    }

    public function updateRoleSwitch(Request $request, User $user)
    {
        $user->syncRoles([$request->role]); 
        return redirect()->back()->with('success', 'Role updated!');
    }


    // -----------------------Editor------------------

    public function indexEditor()
    {
        $articleCount = Article::where('author_id', Auth::id())->count();
        $articleShow = Article::where('author_id', Auth::id())->latest()->get();
        $articles = Article::latest()->get();
        return view('editor.dashboard', compact('articleCount', 'articleShow', 'articles'));
    }

    public function editorArtikel()
    {
        $user = auth()->user();
        $articleCount = Article::where('author_id', Auth::id())->count();
        $articles = Article::where('author_id', $user->id)->latest()->get();
        return view('articles.myarticles', compact('articles', 'articleCount'));
    }

    public function showEditor($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.showuser', compact('article'));
    }

    // ----------------------User -------------------

    public function indexUser()
    {
        $articleTotal = Article::count();
        $articles = Article::latest()->get();
        return view('user.dashboard', compact('articles', 'articleTotal'));
    }

    public function showUser($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.showuser', compact('article'));
    }

    public function updateRole(Request $request, User $user)
    {
        $user->syncRoles([]);

        $user->assignRole($request->role);

        $articleCount = Article::where('author_id', Auth::id())->count();
        $articleShow = Article::where('author_id', Auth::id())->latest()->get();
        $articles = Article::latest()->get();
        
        return view('dashboard', compact('user'));
    }
}
