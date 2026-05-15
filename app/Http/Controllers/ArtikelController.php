<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ArtikelController extends Controller
{
    // -------------------Artikel-----------------
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artikel.create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('artikel.edit', compact('artikel'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'header' => 'required|string|max:250',
            'content' => 'required|string',
        ]);
        
        $validated['author_id'] = Auth::id();
        
        $artikel = Artikel::create($validated);

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
        $artikel = Artikel::findOrFail($id);
        $artikel->update($request->all());
        return redirect()->route('artikel.show', $artikel->id)->with('success', 'Updated');
    }

    public function destroy(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();
        if ($request->query('from') === 'myartikel') {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->with('success', 'Deleted');
            }

            if (auth()->user()->hasRole('editor')) {
                return redirect()->route('editor.myartikel')->with('success', 'Deleted');
            }
        }

        if ($request->query('from') === 'show') {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->with('success', 'Deleted');
            }

            if (auth()->user()->hasRole('editor')) {
                return redirect()->route('editor.myartikel')->with('success', 'Deleted');
            }
        }
        // return redirect()->back()->with('success', 'Deleted');
    }

    // -----------------------Admin Artikel -------------------

    public function indexAdmin()
    {
        $artikelCount = Artikel::where('author_id', Auth::id())->count();
        $artikelShow = Artikel::where('author_id', Auth::id())->latest()->get();
        $artikel = Artikel::latest()->get();
        $artikelTotal = Artikel::count();
        $userTotal = User::count();
        return view('admin.dashboard', compact('artikelCount', 'artikelShow', 'artikel', 'artikelTotal', 'userTotal'));
    }

    public function userTable()
    {
        $user = User::all();
        return view('admin.usertable', compact('user'));
    }

    public function adminArtikel()
    {
        $user = auth()->user();
        $artikelCount = Artikel::where('author_id', Auth::id())->count();
        $artikel = Artikel::where('author_id', $user->id)->latest()->get();
        return view('artikel.adminartikel', compact('artikel', 'artikelCount'));
    }

    public function updateRoleSwitch(Request $request, User $user)
    {
        $user->syncRoles([$request->role]); 
        return redirect()->back()->with('success', 'Role berhasil diubah!');
    }


    // -----------------------Editor------------------

    public function indexEditor()
    {
        $artikelCount = Artikel::where('author_id', Auth::id())->count();
        $artikelShow = Artikel::where('author_id', Auth::id())->latest()->get();
        $artikel = Artikel::latest()->get();
        return view('editor.dashboard', compact('artikelCount', 'artikelShow', 'artikel'));
    }

    public function editorArtikel()
    {
        $user = auth()->user();
        $artikelCount = Artikel::where('author_id', Auth::id())->count();
        $artikel = Artikel::where('author_id', $user->id)->latest()->get();
        return view('artikel.myartikel', compact('artikel', 'artikelCount'));
    }

    public function showEditor($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('artikel.showeditor', compact('artikel'));
    }

    // ----------------------User -------------------

    public function indexUser()
    {
        $artikel = Artikel::latest()->get();
        return view('user.dashboard', compact('artikel'));
    }

    public function showUser($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('artikel.showuser', compact('artikel'));
    }

    public function updateRole(Request $request, User $user)
    {
        $user->syncRoles([]);

        $user->assignRole($request->role);

        $artikelCount = Artikel::where('author_id', Auth::id())->count();
        $artikelShow = Artikel::where('author_id', Auth::id())->latest()->get();
        $artikel = Artikel::latest()->get();

        // return view('editor.dashboard', compact('user', 'artikelCount', 'artikelShow', 'artikel'));
        return view('welcome', compact('user'));
    }
}
