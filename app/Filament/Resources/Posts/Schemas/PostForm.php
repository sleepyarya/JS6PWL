<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Input Judul dengan fitur Auto-Slug
                TextInput::make('title')
                    ->label('Judul Postingan')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => 
                        $set('slug', Str::slug($state))
                    ),

                // Input Slug (Otomatis terisi dari Judul)
                TextInput::make('slug')
                    ->label('Slug / URL')
                    ->required()
                    ->maxLength(255)
                    ->unique(table: 'posts', column: 'slug', ignoreRecord: true)
                    ->helperText('Otomatis terisi saat Judul selesai diketik.'),

                // Dropdown Pilih Kategori (Relasi Foreign Key)
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'category_name') // 'category' adalah nama fungsi di model Post
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([ // Fitur bonus: bisa tambah kategori langsung dari sini
                        TextInput::make('category_name')
                            ->required(),
                    ]),

                // Input Konten
                Textarea::make('content')
                    ->label('Isi Konten')
                    ->required()
                    ->rows(10)
                    ->columnSpanFull(), // Biar tampilannya lebar sampai ujung
            ]);
    }
}