<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    use Prunable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'excerpt',
        'thumbnail',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
        'category_ids' => 'array',
    ];



    protected $with = ['author', 'categories'];

    /**
     * Get post author
     * @return BelongTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get post categories
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    /**
     * Get post comments
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->HasMany(Comment::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where(
                fn ($query) => $query->where('title', 'like', '%' . trim($search) . '%')
                    ->orWhere('content', 'like', '%' . trim($search) . '%')
            )
        );

        $query->when($filters['category'] ?? false, fn ($query, $category) =>
        $query->whereHas('categories', fn ($query) => $query->where('slug', $category)));
    }

    /**
     * Set the post's slug.
     *
     * @param  string  $slug
     * @return void
     */

    public function setSlugAttribute($slug){
        $this->attributes['slug'] = Str::slug($slug);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, Comment::class);
    }

    /**
     * Get the prunable model query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function prunable()
    {
        return static::where('created_at', '<=', now()->subMonth());
    }

    /**
     * Prepare the model for pruning.
     *
     * @return void
     */
    protected function pruning()
    {
     Comment::destroy(static::comments()->pluck('id'));
    }
}
