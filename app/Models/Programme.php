<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Programme extends Model
{
    use HasFactory;

    protected $fillable=['name','institute_id'];

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

}
