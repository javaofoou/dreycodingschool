<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [

            [
                'student_name' => 'Aisha Bello',
                'course_taken' => 'HTML & CSS Fundamentals',
                'comment' => 'DreyCoding School made web development easy to understand. I enjoyed every class.',
                'student_image' => 'https://via.placeholder.com/150',
            ],

            [
                'student_name' => 'Samuel Ade',
                'course_taken' => 'Basic Full-Stack',
                'comment' => 'The teaching was practical and straight to the point. I can now build websites confidently.',
                'student_image' => 'https://via.placeholder.com/150',
            ],

            [
                'student_name' => 'David John',
                'course_taken' => 'MERN Stack',
                'comment' => 'One of the best learning experiences I’ve had. Highly recommended.',
                'student_image' => 'https://via.placeholder.com/150',
            ],

        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create([
                'student_name' => $testimonial['student_name'],
                'course_taken' => $testimonial['course_taken'],
                'comment' => $testimonial['comment'],
                'student_image' => $testimonial['student_image'],
                'is_active' => true,
            ]);
        }
    }
}
