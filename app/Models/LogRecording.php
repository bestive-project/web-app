<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogRecording extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        "live_class_id",
        "link_title",
        "link_recording",
        "uuid",
    ];

    protected $hidden = [
        "live_class_id",
        "id",
    ];

    public function liveClass(): BelongsTo
    {
        return $this->belongsTo(LiveClass::class, 'live_class_id', 'id');
    }
}
