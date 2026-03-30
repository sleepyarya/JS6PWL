<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
// IMPORT ACTION DI BAWAH INI WAJIB ADA (Filament v4):
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.category_name')
                    ->label('Category'),

                TextColumn::make('color')
                    ->label('Color')
                    ->formatStateUsing(fn($state) => '<span style="display:inline-block;width:20px;height:20px;background:'.$state.';border-radius:4px;border:1px solid #333;"></span>')
                    ->html(),

                ToggleColumn::make('is_published')
                    ->label('Published'),

                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->circular(),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }
}