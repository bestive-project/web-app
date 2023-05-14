<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogRecording extends Model
{
    use HasFactory, Uuid;

    const TYPE_LIVECLASS = "App\Models\LiveClass";

    const TYPE_LIVECOUNSELING = "App\Models\LiveCounseling";

    protected $fillable = [
        "live_id",
        "link_title",
        "link_recording",
        "log_type",
        "uuid",
    ];

    protected $hidden = [
        "live_class_id",
        "log_type",
        "id",
    ];

    public function liveClass(): BelongsTo
    {
        return $this->belongsTo(LiveClass::class, 'live_id', 'id');
    }

    public function liveCounseling(): BelongsTo
    {
        return $this->belongsTo(LiveCounseling::class, 'live_id', 'id');
    }
}
