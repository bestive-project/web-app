<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counselor extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "age",
        "study",
        "major",
        "uuid",
    ];

    protected $hidden = [
        "user_id",
        "id",
    ];
}
