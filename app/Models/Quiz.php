<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory, Uuid;

    const QUIZ_CHAPTER = "App\Models\Chapter";

    const QUIZ_COURSE = "App\Models\Course";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = ['id', 'quizzable_type', 'quizzable_id'];

    public function quizzable()
    {
        return $this->morphTo();
    }
}
