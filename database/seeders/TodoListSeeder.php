<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class TodoListSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        // Generate 5 fake records
        foreach (range(1, 5) as $index) {
            DB::table('todo_lists')->insert([
                'item' => $faker->sentence, // Generate a random sentence
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
