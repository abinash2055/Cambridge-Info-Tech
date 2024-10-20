<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FaqCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status'];

    // Mutator to set the slug with timestamp
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($this->attributes['name'], '-') . '-' . time();
    }
}
