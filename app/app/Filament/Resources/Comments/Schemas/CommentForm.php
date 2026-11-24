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
                    ->searchable() // Memudahkan pencarian judul berita
                    ->preload()    // Memuat data saat dropdown dibuka
                    ->required()
                    ->label('Berita'),

                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable() // Bisa kosong jika komentar dari guest (tanpa login)
                    ->label('User (Opsional)'),

                TextInput::make('author_name')
                    ->required()
                    ->maxLength(100)
                    ->label('Nama Penulis'),

                TextInput::make('author_email')
                    ->email()
                    ->required()
                    ->maxLength(100)
                    ->label('Email Penulis'),

                Textarea::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->rows(4)
                    ->label('Isi Komentar'),

                // --- PERBAIKAN: Hapus ->colors(), cukup options saja ---
                Select::make('status')
                    ->options([
                        'pending' => 'Pending (Menunggu Moderasi)',
                        'approved' => 'Approved (Disetujui & Ditampilkan)',
                        'rejected' => 'Rejected (Ditolak / Spam)',
                    ])
                    ->default('pending')
                    ->required()
                    ->label('Status Moderasi'),
                // -------------------------------------------------------

                TextInput::make('likes_count')
                    ->numeric()
                    ->default(0)
                    ->disabled() // Admin jarang perlu mengubah ini manual
                    ->label('Jumlah Like'),

                TextInput::make('dislikes_count')
                    ->numeric()
                    ->default(0)
                    ->disabled()
                    ->label('Jumlah Dislike'),

                Select::make('parent_id')
                    ->relationship('parent', 'content') // Menampilkan isi komentar induk agar mudah dikenali
                    ->searchable()
                    ->nullable()
                    ->label('Balasan dari Komentar (Opsional)'),
            ]);
    }
}