<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Teacher',
            'email' => 'user@teacher.com',
            'password' => bcrypt('12345678'), // password
            'role' => 'teacher'
        ]);
        
        User::create([
            'name' => 'Student',
            'email' => 'user@student.com',
            'password' => bcrypt('12345678'), // password
        ]);

        $this->call([
            ClassSeeder::class,
            WeekSeeder::class,
        ]);
    }
}
