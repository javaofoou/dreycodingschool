<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'whatsapp_number',
        'project_type',
        'budget_range',
        'project_description',
        'status',
    ];
}