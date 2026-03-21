<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // Gunakan \Filament\Forms\Components\TextInput biar fix gak nyari di folder lokal
                \Filament\Forms\Components\TextInput::make('category_name')
                    ->label('Nama Kategori')
                    ->required()
                    ->placeholder('Contoh: Web Programming')
                    // ignoreRecord: true penting biar pas Edit gak dianggap duplikat
                    ->unique(table: 'categories', column: 'category_name', ignoreRecord: true),
            ]);
    }
}