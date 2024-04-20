<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Practical extends Model
{
    use HasFactory;
    protected $fillable=['name','institute_id'];

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    public function modules() : BelongsToMany
    {
        return $this->belongsToMany(Module::class)->withTimestamps();
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)->withTimestamps();
    }

}
