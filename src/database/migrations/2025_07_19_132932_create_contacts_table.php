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
        Schema::create('contacts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('categories'); // 外部キー
        $table->string('first_name');
        $table->string('last_name');
        $table->string('gender',10); // 1:男性, 2:女性, 3:その他
        $table->string('email')->unique();
        $table->string('tel');
        $table->string('address');
        $table->string('building')->nullable();
        $table->text('detail')->nullable();
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
