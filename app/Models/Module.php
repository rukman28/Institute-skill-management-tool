<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Module extends Model
{
    use HasFactory;

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    protected $fillable=['name','institute_id'];

}
