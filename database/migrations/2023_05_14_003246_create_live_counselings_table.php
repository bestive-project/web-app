<?php

use App\Models\StudyGroup;
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
        Schema::create('live_counselings', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(StudyGroup::class);
            $table->string('link_meet');
            $table->dateTime('date_meet')->nullable();
            $table->string('hour');
            $table->string('day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_counselings');
    }
};
