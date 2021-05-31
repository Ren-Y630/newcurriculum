<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// 以下を追記することでPost Modelが扱えるようになる
use App\Models\Post;

// controllerを継承してSnsControllerクラスを作っている
class SnsController extends Controller
{

    public function create(Request $request)
    {

        // Varidationを行う
        $this->validate($request, Post::$rules);

        // 入力された情報の取得
        $post = new Post;
        $form = $request->all();
        $user_id = Auth::user()->id;
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        // データベースに保存する
        $post->user_id=$user_id;
        $post->fill($form);
        $post->save();

        // admin/sns/createにリダイレクトする
        return redirect('admin/sns/create');
    }


    public function index(Request $request)
    {
         // 一覧表示
        $posts = Post::all()->sortByDesc("id");
        // dd($posts);
        return view('admin.sns.create', ['posts' => $posts]);
    }


    public function delete(Request $request)
    {

        // 該当するPost Modelを取得
        $post = Post::find($request->id);
        // dd($post);

        // 削除する
        $post->delete();
        return redirect('admin/sns/create');
    }


}
