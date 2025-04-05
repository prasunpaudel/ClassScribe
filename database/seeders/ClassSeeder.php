<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'name' => 'Class 1',
            ],
            [
                'name' => 'Class 2',
            ],
            [
                'name' => 'Class 3',
            ],
            [
                'name' => 'Class 4',
            ],
            [
                'name' => 'Class 5',
            ],
        ];
        \App\Models\ClassName::insert($data);
    }
}
