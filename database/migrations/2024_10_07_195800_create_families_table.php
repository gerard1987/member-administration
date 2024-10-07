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
        Schema::create('families', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('name');  // Name of the family
            $table->string('adress');
            $table->timestamps();  // Created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('families');
    }
};
