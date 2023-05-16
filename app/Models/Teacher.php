<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        "user_id",
        "age",
        "study",
        "major",
        "interest",
        "uuid",
    ];

    protected $hidden = [
        "user_id",
        "id",
    ];
}
