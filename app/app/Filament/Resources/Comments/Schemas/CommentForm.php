<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('news_id')
                    ->relationship('news', 'title')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('author_name'),
                TextInput::make('author_email')
                    ->email(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                TextInput::make('likes_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('dislikes_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('parent_id')
                    ->relationship('parent', 'id'),
            ]);
    }
}
