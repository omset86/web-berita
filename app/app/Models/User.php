<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'bio',
        'avatar',
        'social_twitter',
        'social_linkedin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Fitur Laravel 11+ untuk auto-hash
        ];
    }

    // Wajib untuk Filament 5: Tentukan siapa yang boleh akses admin panel
    public function canAccessPanel(Panel $panel): bool
    {
        // Hanya role 'admin' dan 'editor' yang bisa masuk ke panel Filament
        return in_array($this->role, ['admin', 'editor']);
    }
}