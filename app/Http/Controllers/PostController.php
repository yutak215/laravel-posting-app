<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    // 一覧ページ
    public function index()
    {
        // Auth::user()->posts()で現在ログイン中のユーザーに属するすべての投稿を取得
        // orderBy()メソッドをつなげることで作成日時が新しい順に並べ替え
        $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->get();

        return view('posts.index', compact('posts'));
    }

    // 詳細ページ
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 作成ページ
    public function create()
    {
        return view('posts.create');
    }
}
