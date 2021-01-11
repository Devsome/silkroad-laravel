<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var string[]
     */
    protected $fillable = [
        'title', 'slug', 'state'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * When the page is active
     */
    public const PAGE_ACTIVE = 'active';

    /**
     * When the page is disabled
     */
    public const PAGE_DISABLED = 'disabled';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getContent(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PagesContent::class);
    }
}
