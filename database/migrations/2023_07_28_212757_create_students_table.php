<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('name')->nullable();
            $table->string('fatherName')->nullable();
            $table->string('motherName')->nullable();
            $table->date('birthDate')->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('email')->nullable();
            $table->text('image')->nullable();
            $table->text('address')->nullable();
            $table->string('class')->nullable();
            $table->string('section')->nullable();
            $table->string('rollNo')->nullable();
            $table->string('regNo')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
