<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // 論理消去
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //テーブル名
    protected $table = 'posts';

    // 可変項目
    protected $fillable =
    [
        'body'
    ];

    // バリデーション
    public static $rules = array(
        'body' => 'required',
    );


    /**
     * このコメントを所有するポストを取得
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
