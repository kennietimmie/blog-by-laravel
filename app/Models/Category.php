<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    /**
     * Get posts with category
     * @return belongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }

    /**
     * Get the category's first name.
     *
     * @param  string  $value
     * @return string
     */

    public function getNameAttribute($value){
        return ucwords($value);
    }

    /**
     * Set slug
     * @param string $slug
     */
    public function getSlugAttribute($slug){
        $this->attributes['slug'] = Str::slug($slug);
    }
}
