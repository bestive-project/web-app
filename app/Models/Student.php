<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        "user_id",
        "study_group_id",
        "birth_place",
        "date_birth",
        "class",
        "school",
        "phone"
    ];

    protected $hidden = ["id", "user_id", "study_group_id"];

    public function studyGroup(): BelongsTo
    {
        return $this->belongsTo(StudyGroup::class, "study_group_id", "id");
    }

    public function scopeStudyGroupNull(Builder $query)
    {
        $query->where("study_group_id", 0);
    }
}
