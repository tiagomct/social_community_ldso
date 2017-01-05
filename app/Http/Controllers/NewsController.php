<?php

namespace App\Http\Controllers;

use App\NewsEntry;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsEntry::with('likes')->withCount('likes')->orderBy('created_at', 'desc')->paginate(self::DEFAULT_PAGINATION);

        return view('news.index', compact('news'));
    }

    public function show(NewsEntry $newsEntry)
    {
        return view('news.show', compact('newsEntry', 'comments'));
    }
}
