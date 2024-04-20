<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skillcategory extends Model
{
    use HasFactory;
    protected $fillable=['name','institute_id'];

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }


    public function skills(): HasMany
    {
       return $this->hasMany(Skill::class);
    }


}
