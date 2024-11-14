<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    // 一覧ページ
    public function index()
    {
        // Auth::user()->posts()で現在ログイン中のユーザーに属するすべての投稿を取得
        // orderBy()メソッドをつなげることで作成日時が新しい順に並べ替え
        $posts = Auth::user()->posts()->orderBy('updated_at', 'ASC')->get();

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

    // 作成機能

    // PostRequest $request：この $request は、PostRequest でバリデーション（入力チェック）済みのリクエストや。つまり、不正なデータはここで弾かれてるから安心やで。
    public function store(PostRequest $request)
    {
        // 空の Post インスタンスを新しく作って、これにデータを入れていくねん。
        $post = new Post();
        // フォームで送られてきた title と content のデータを Post インスタンスに入れてる。
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        // 投稿したユーザーの ID を user_id にセットして、誰が投稿したか分かるようにしとる。
        $post->user_id = Auth::id();
        $post->save();

        // 投稿が成功したら、投稿一覧ページにリダイレクトして、投稿が完了しました。 ってフラッシュメッセージを表示するようになっとる。
        return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
    }

    // 編集ページ
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        return view('posts.edit', compact('post'));
    }

    // 更新機能
    // 第一引数はユーザーが入力した情報が入ってきている
    // 第二引数は更新したい対象の投稿データそのもの
    public function update(PostRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.show', $post)->with('flash_message', '投稿を編集しました。');
    }

    // 削除機能
    public function destroy(Post $post) {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('flash_message', '投稿を削除しました。');
    }
}
