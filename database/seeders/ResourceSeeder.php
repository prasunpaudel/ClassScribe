<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'week_id' => 1,
                'link' => 'https://www.example.com/resource1',
            ],
            [
                'week_id' => 2,
                'link' => 'https://www.example.com/resource2',
            ],
            [
                'week_id' => 3,
                'link' => 'https://www.example.com/resource3',
            ],
        ];
        \App\Models\Resource::insert($data);
    }
}
