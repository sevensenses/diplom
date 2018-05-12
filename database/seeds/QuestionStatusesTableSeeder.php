<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_statuses')->insert([
            'name' => 'Ожидает ответа',
        ]);

        DB::table('question_statuses')->insert([
            'name' => 'Опубликован',
        ]);

        DB::table('question_statuses')->insert([
            'name' => 'Скрыт',
        ]);
    }
}
