<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [

            [
                'title' => 'HTML & CSS Fundamentals',
                'short_description' => 'Learn the building blocks and foundation of modern websites.',
                'full_description' => 'This course teaches you how to structure web pages with HTML and style them using CSS. Perfect for beginners.',
                'price' => 80000,
            ],

            [
                'title' => 'Basic Full-Stack Web Development',
                'short_description' => 'Learn HTML, CSS, JavaScript and PHP for full website development.',
                'full_description' => 'This package covers frontend and backend fundamentals to help you build complete web applications.',
                'price' => 180000,
            ],

            [
                'title' => 'Modern Web Development Stack (MERN)',
                'short_description' => 'Go beyond basics with MongoDB, React, Node.js, and Express.',
                'full_description' => 'Includes full-stack fundamentals plus modern JavaScript frameworks to build scalable web applications.',
                'price' => 250000,
            ],

            [
                'title' => 'Python Programming',
                'short_description' => 'Learn core Python programming from scratch.',
                'full_description' => 'Master Python fundamentals including variables, loops, functions, and problem-solving.',
                'price' => 200000,
            ],

            [
                'title' => 'Full Software Development Package',
                'short_description' => 'Web development + mobile app development.',
                'full_description' => 'Includes MERN stack plus cross-platform mobile app development for complete software training.',
                'price' => 550000,
            ],
        ];

        foreach ($courses as $course) {
            Course::create([
                'title' => $course['title'],
                'slug' => Str::slug($course['title']),
                'short_description' => $course['short_description'],
                'full_description' => $course['full_description'],
                'price' => $course['price'],
                'is_active' => true,
            ]);
        }
    }
}
