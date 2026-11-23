<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('role')
                    ->required()
                    ->default('author'),
                Textarea::make('bio')
                    ->columnSpanFull(),
                TextInput::make('avatar'),
                TextInput::make('social_twitter'),
                TextInput::make('social_linkedin'),
            ]);
    }
}
