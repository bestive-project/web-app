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
        Schema::table('students', function (Blueprint $table) {
            $table->string("birth_place")->nullable()->change();
            $table->dateTime("date_birth")->nullable()->change();
            $table->string("class")->nullable()->change();
            $table->string("school")->nullable()->change();
        });
    }
};
