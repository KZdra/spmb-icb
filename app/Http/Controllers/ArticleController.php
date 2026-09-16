<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ArticleController extends Controller
{
    /**
     * Admin: List all articles
     */
    public function index()
    {
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        return view('articles.index', compact('articles'));
    }

    /**
     * Admin: Show create form
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Admin: Store new article
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'ringkasan' => 'nullable|string|max:500',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
            'penulis' => 'nullable|string|max:100',
            'is_published' => 'nullable|boolean',
        ]);

        $slug = Str::slug($validated['judul']);
        if (Article::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('articles', 'public');
        }

        Article::create([
            'judul' => $validated['judul'],
            'slug' => $slug,
            'kategori' => $validated['kategori'],
            'ringkasan' => $validated['ringkasan'] ?? Str::limit(strip_tags($validated['konten']), 160),
            'konten' => $validated['konten'],
            'gambar' => $gambarPath,
            'penulis' => $validated['penulis'] ?: 'Panitia SPMB',
            'is_published' => $request->has('is_published') ? (bool)$request->is_published : true,
        ]);

        Alert::success('Berhasil!', 'Artikel berhasil ditambahkan.');
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Admin: Show edit form
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Admin: Update article
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'ringkasan' => 'nullable|string|max:500',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
            'penulis' => 'nullable|string|max:100',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($article->gambar && Storage::disk('public')->exists($article->gambar)) {
                Storage::disk('public')->delete($article->gambar);
            }
            $article->gambar = $request->file('gambar')->store('articles', 'public');
        }

        $article->judul = $validated['judul'];
        $article->kategori = $validated['kategori'];
        $article->ringkasan = $validated['ringkasan'] ?? Str::limit(strip_tags($validated['konten']), 160);
        $article->konten = $validated['konten'];
        $article->penulis = $validated['penulis'] ?: 'Panitia SPMB';
        $article->is_published = $request->has('is_published') ? (bool)$request->is_published : true;
        $article->save();

        Alert::success('Berhasil!', 'Artikel berhasil diperbarui.');
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Admin: Delete article
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->gambar && Storage::disk('public')->exists($article->gambar)) {
            Storage::disk('public')->delete($article->gambar);
        }
        $article->delete();

        Alert::success('Berhasil!', 'Artikel telah dihapus.');
        return redirect()->route('articles.index')->with('success', 'Artikel telah dihapus.');
    }

    /**
     * Public: Read article detail
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $article->increment('views');
        $recentArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();

        return view('articles.show', compact('article', 'recentArticles'));
    }
}
