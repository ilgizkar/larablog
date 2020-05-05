<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            ['user_id' => 1, 'post_id' => 1, 'content' => 'Какой то коммент 1'],
            ['user_id' => 1, 'post_id' => 2, 'content' => 'Какой то коммент 2'],
            ['user_id' => 1, 'post_id' => 3, 'content' => 'Какой то коммент 3'],
        ]);
    }
}
