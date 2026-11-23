<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_name',
        'site_tagline',
        'ticker_text',
        'ticker_enabled',
        'location_text',
        'footer_about',
        'footer_address',
        'footer_phone',
        'footer_email',
        'social_facebook',
        'social_twitter',
        'social_instagram',
        'social_youtube',
        'meta_title',
        'meta_description',
        'google_analytics',
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
            'ticker_enabled' => 'boolean',
        ];
    }
}
