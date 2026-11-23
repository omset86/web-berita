<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdSlot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'position',
        'html_content',
        'image_url',
        'link_url',
        'width',
        'height',
        'is_active',
        'starts_at',
        'ends_at',
        'impressions',
        'clicks',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'is_active' => 'boolean',
            'starts_at' => 'timestamp',
            'ends_at' => 'timestamp',
            'impressions' => 'integer',
            'clicks' => 'integer',
        ];
    }
}
