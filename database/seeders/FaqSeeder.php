<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [

            [
                'question' => 'How are the classes conducted?',
                'answer' => 'Classes are conducted via WhatsApp groups and Google Meet live sessions.',
            ],

            [
                'question' => 'Will I be added to a WhatsApp group?',
                'answer' => 'Yes, after successful payment you will be added to the course WhatsApp group.',
            ],

            [
                'question' => 'Do I need a laptop?',
                'answer' => 'Yes, a laptop is required for all development courses.',
            ],

            [
                'question' => 'Are the classes beginner-friendly?',
                'answer' => 'Yes, all courses are structured to guide beginners step by step.',
            ],

            [
                'question' => 'How long does each course last?',
                'answer' => 'Course duration varies depending on the package selected.',
            ],

        ];

        foreach ($faqs as $faq) {
            Faq::create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'is_active' => true,
            ]);
        }
    }
}
