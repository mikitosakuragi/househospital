<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('pic_main');
            $table->string('pic_sub1')->nullable();
            $table->string('pic_sub2')->nullable();
            $table->string('content');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};

// 'id',
//         'user_id',
//         'name',
//         'title',
//         'pic_main',
//         'pic_sub1',
//         'pic_sub2',
//         'content',
//         'created_at',