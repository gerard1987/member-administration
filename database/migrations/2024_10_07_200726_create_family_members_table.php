<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('name');
            $table->date('date_of_birth');
            $table->foreignId('member_type_id');
            $table->foreignId('family_id')->constrained()->onDelete('cascade');  // Foreign key referencing the families table
            $table->timestamps();  // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
