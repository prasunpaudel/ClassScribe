<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // id	class_name_id	week_id	topic_covered	important_points	practical_implementation	week_summary	next_topic	next_session_prep	created_at	updated_at	
        $data=[
            [
                'class_name_id' => 1,
                'week_id' => 1,
                'topic_covered' => 'Introduction to Programming',
                'important_points' => 'Variables, Data Types, Control Structures',
                'practical_implementation' => 'Basic Calculator',
                'week_summary' => 'Learned about variables and data types.',
                'next_topic' => 'Functions and Methods',
                'next_session_prep' => 'Read Chapter 2 of the textbook.',
            ],
            [
                'class_name_id' => 1,
                'week_id' => 2,
                'topic_covered' => 'Functions and Methods',
                'important_points' => 'Function Definition, Parameters, Return Values',
                'practical_implementation' => 'Create a function to calculate factorial.',
                'week_summary' => 'Learned about functions and their usage.',
                'next_topic' => 'Object-Oriented Programming',
                'next_session_prep' => 'Read Chapter 3 of the textbook.',
            ],
            [
                'class_name_id' => 1,
                'week_id' => 3,
                'topic_covered' => 'Object-Oriented Programming',
                'important_points' => 'Classes, Objects, Inheritance',
                'practical_implementation' => 'Create a class for a simple bank account.',
                'week_summary' => 'Learned about OOP concepts.',
                'next_topic' => 'Data Structures',
                'next_session_prep' => 'Read Chapter 4 of the textbook.',
            ],
        ];
        \App\Models\Week::insert($data);
    }
}
