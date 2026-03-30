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
                \Filament\Forms\Components\TextInput::make('category_name')
                    ->label('Nama Kategori')
                    ->required()
                    ->placeholder('Contoh: Web Programming')
                    ->unique(table: 'categories', column: 'category_name', ignoreRecord: true),

                \Filament\Forms\Components\ColorPicker::make('color')
                    ->label('Color')
                    ->required(),
            ]);
    }
}