<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'student_image',
        'student_image_public_id',
        'course_taken',
        'comment',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}