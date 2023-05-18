<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudyGroup extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        "name",
        "uuid",
    ];

    protected $hidden = [
        'id',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, "study_group_id", "id");
    }

    public function discussion(): HasOne
    {
        return $this->hasOne(Discussion::class, "study_group_id", "id");
    }

    public function liveClass(): BelongsTo
    {
        return $this->belongsTo(LiveClass::class, "id", "study_group_id");
    }

    public function liveCounseling(): BelongsTo
    {
        return $this->belongsTo(LiveCounseling::class, "id", "study_group_id");
    }
}
