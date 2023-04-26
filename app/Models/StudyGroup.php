<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
