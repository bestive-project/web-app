<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        "user_id",
        "birth_place",
        "date_birth",
        "class",
        "school",
        "phone"
    ];

    protected $hidden = ["id", "user_id"];
}
