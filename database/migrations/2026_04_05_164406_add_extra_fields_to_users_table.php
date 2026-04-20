<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('whatsapp_number')->after('email');
            $table->string('profile_image')->nullable()->after('whatsapp_number');
            $table->string('profile_image_public_id')->nullable()->after('profile_image');
            $table->string('role')->default('student')->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_number',
                'profile_image',
                'profile_image_public_id',
                'role',
            ]);
        });
    }
};
