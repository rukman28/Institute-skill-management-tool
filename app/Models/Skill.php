<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;
    protected $fillable=['name','institute_id','skillcategory_id'];

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    public function practicals(): BelongsToMany
    {
        return $this->belongsToMany(Practical::class)->withTimestamps();
    }

    public function skillcategory(): BelongsTo
    {
        return $this->belongsTo(Skillcategory::class);
    }


}
