<?php

use App\Models\LogRecording;
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
        Schema::table('log_recordings', function (Blueprint $table) {
            $table->string("log_type")->default(LogRecording::TYPE_LIVECLASS)->after('uuid');
            $table->renameColumn("live_class_id", "live_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_recordings', function (Blueprint $table) {
            $table->dropColumn("log_type");
            $table->renameColumn("live_id", "live_class_id");
        });
    }
};
