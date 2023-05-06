<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Chapter extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'uuid',
        'user_id',
        'course_id',
        'chapter_name',
        'chapter_description',
        'chapter_status',
        'chapter_slug',
    ];

    protected $hidden = [
        'id',
        'user_id',
        'course_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function document(): MorphOne
    {
        return $this->morphOne(Document::class, 'documentable');
    }
}
