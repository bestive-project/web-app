<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'category_name',
        'category_slug',
        'category_uuid',
        'category_status',
    ];

    protected $hidden = [
        'id'
    ];
}
