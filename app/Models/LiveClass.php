<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LiveClass extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        "study_group_id",
        "link_meet",
        "date_meet",
        "day",
        "hour",
        "uuid",
    ];

    protected $hidden = [
        "study_group_id",
        "id",
    ];

    public function studyGroup(): HasOne
    {
        return $this->hasOne(StudyGroup::class, 'id', 'study_group_id');
    }

    public function logRecordings(): HasMany
    {
        return $this->hasMany(LogRecording::class, 'live_class_id', 'id');
    }
}
