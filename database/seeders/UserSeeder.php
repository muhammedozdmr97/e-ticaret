<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Muhammed',
                'email' => 'muhammedozdmr4@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$nJv9hNFQn6uBxGLqZHXlPOKkQW7FBRUHmJuI8e0GBTzbC4rBUxgs6',
                'remember_token' => Str::random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Guray',
                'email' => 'guraymanav@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$C9pZauXJRrlyFqj7wk/KReNrXr5fY6M1wSdHd/sqfYMQ3WZRfKRZO',
                'remember_token' => Str::random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
