<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),

            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),

            TextInput::make('excerpt')
                ->maxLength(255)
                ->columnSpanFull(),

            RichEditor::make('content')
                ->required()
                ->fileAttachmentsDirectory('news/content')
                ->columnSpanFull(),

            FileUpload::make('image')
                ->image()
                ->directory('news')
                ->disk('public')
                ->maxSize(2048)
                // Logic hapus gambar lama saat diganti
                ->afterStateUpdated(function ($state, $old, $record) {
                    if ($state !== $old && $old && \Illuminate\Support\Facades\Storage::disk('public')->exists($old)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($old);
                    }
                }),

            Select::make('category_id')
                ->label('Category')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('author_id')
                ->label('Author')
                ->relationship('author', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('tags')
                ->relationship('tags', 'name')
                ->multiple()
                ->preload()
                ->searchable(),

            Toggle::make('is_featured')
                ->label('Featured'),

            Toggle::make('is_published')
                ->label('Published'),

            DateTimePicker::make('published_at')
                ->label('Publish Date'),

            TextInput::make('reading_time')
                ->numeric()
                ->default(5),

            ]);
    }
}
