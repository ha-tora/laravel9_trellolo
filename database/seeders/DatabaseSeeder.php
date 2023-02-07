<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Card;
use App\Models\Column;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create();
        Column::factory(20)
            ->sequence(fn($sequence) => ['user_id' => User::all('id')->random()])
            ->create();
        Card::factory(30)
            ->sequence(fn($sequence) => ['user_id' => User::all('id')->random()])
            ->sequence(fn($sequence) => ['column_id' => Column::all('id')->random()])
            ->create();
        Comment::factory(50)
            ->sequence(fn($sequence) => ['user_id' => User::all('id')->random()])
            ->sequence(fn($sequence) => ['card_id' => Card::all('id')->random()])
            ->create();
    }
}