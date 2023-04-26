<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Discussion extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        "wa_link",
        "discord_link",
        "uuid",
    ];

    protected $hidden = [
        'id',
        'study_group_id'
    ];

    public function studyGroup(): HasOne
    {
        return $this->hasOne(StudyGroup::class, "id", "study_group_id");
    }
}
