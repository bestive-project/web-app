<?php

use App\Models\LiveClass;
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
        Schema::create('log_recordings', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(LiveClass::class);
            $table->string("link_title");
            $table->string("link_recording");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_recordings');
    }
};
