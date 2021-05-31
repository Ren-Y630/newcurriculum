<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Factoryを設定
        //データベースにデータを追加する処理
        factory(Post::class, 3)->create();
    }
}
