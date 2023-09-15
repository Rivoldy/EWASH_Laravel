<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => \Hash::make('12345678'),
                'isAdmin' => true
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => \Hash::make('12345678'),
                'isAdmin' => false
            ]
        ]);
    
    }
}
