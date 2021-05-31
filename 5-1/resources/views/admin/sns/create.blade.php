@extends('layouts.admin')
@section('title', 'snsの新規作成')

@section('content')
    <div class="container"  style="margin-top:40px;">
        <div style="width:600px; margin:auto;">
            <div style="border:1px solid #dcdcdc; width:600px;">
                <p style="font-size:16px; margin-top:16px; margin-left:20px;">ホーム</p>
                <form action="{{ action('Admin\SnsController@create') }}" method="post" enctype="multipart/form-data">
                <!-- `$errors` は `validate` で弾かれた内容を記憶する配列 -->
                @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div style="height:150px; border:1px solid #dcdcdc; text-align: center;">
                        <div style="padding-top:30px;">
                            <div>
                                <!-- oldヘルパ関数は、セッションにフラッシュデータ（一時的にしか保存されないデータ）として入力されているデータを取得する -->
                                <input type="text" name="body" value="{{ old('body') }}" placeholder="いまどうしてる？" style=" width:450px;">
                            </div>
                        </div>
                        <div style="width:450px; margin:auto; text-align: right;">
                        <!-- トークン隠しフィールドを生成 -->
                        {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="つぶやく" style="color: #000; background-color: #dcdcdc; border:none; margin-top:20px;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="tweet-list" style="width:600px; margin:auto; margin-top:20px; border:1px solid #dcdcdc;">
    <!-- 一覧表示 -->
        @foreach($posts as $sns)
        <div class="tweet-content" style="border:1px solid #dcdcdc; padding:20px;">
            <div class="tweet-wrap" style="display: flex;">
                <div class="tweet-name" style="font-weight: bold; font-size:18px;"><p>{{ $sns->user->name }}</p></div>
                <div class="tweet-time" style="margin-left:auto;">{{ str_limit($sns->created_at) }}</div>
            </div>
            <div class="tweet-box" style="display: flex;  margin-top:10px;">
                <div class="tweet-text" style="font-size:18px; line-height: 1.5;"><p>{{ str_limit($sns->body, 255) }}</p></div>
            </div>
        <!-- 論理消去 -->
        <!-- ログインしているユーザーと投稿したユーザーが同じであれば消去ボタンの表示をする -->
            @if (Auth::user()->id == $sns->user->id )
            <div style=" text-align: right;">
                <div class="form-check">
                    <a href="{{ action('Admin\SnsController@delete', ['id' => $sns->id]) }}" class="btn btn-primary" style="color: #ff0000; background-color: #fff; border:none; font-size:18px;">削除</a>
                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
@endsection