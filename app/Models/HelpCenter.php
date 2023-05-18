<?php

namespace App\Models;

use App\Http\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    use HasFactory, Uuid;

    const TYPE_COUNSELING = "COUNSELING";

    const TYPE_TEACHER = "TEACHER";

    const TYPE_OTHER = "OTHER";

    protected $fillable = [
        'assign_from',
        'assign_to',
        'type',
        'message',
    ];

    public function assignFrom()
    {
        return $this->hasOne(User::class, "id", "assign_from");
    }

    public function assignTo()
    {
        return $this->hasOne(User::class, "id", "assign_to");
    }
}
