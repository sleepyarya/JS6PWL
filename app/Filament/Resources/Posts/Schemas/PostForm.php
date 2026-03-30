<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
// Namespace Section sesuai yang tidak merah di tempatmu
use Filament\Schemas\Components\Section; 
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            
            // SECTION 1: KONTEN UTAMA (Ambil 2 bagian dari 3 kolom)
            Section::make('Konten Utama')
                ->description('Kelola judul, isi, dan kategori post di sini.')
                ->icon('heroicon-o-document-text')
                ->schema([
                    // Judul dengan Validasi J.6
                    TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->minLength(5)
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => 
                            $set('slug', Str::slug($state))
                        )
                        ->validationMessages([
                            'min' => 'Judul minimal 5 karakter!',
                        ]),

                    // Kategori dengan Validasi J.6
                    Select::make('category_id')
                        ->label('Kategori')
                        ->relationship('category', 'category_name')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->helperText('Kategori wajib dipilih!'),

                    // Color Picker J.5
                    ColorPicker::make('color')
                        ->label('Warna')
                        ->required(),

                    // Editor Konten J.4 & J.5
                    RichEditor::make('content')
                        ->label('Isi Konten')
                        ->required()
                        ->columnSpanFull(),
                ])
                ->columns(2) // Membuat field di dalam section ini jadi 2 kolom
                ->columnSpan(2),

            // SECTION 2: META DATA & MEDIA (Ambil 1 bagian dari 3 kolom)
            Section::make('Meta & Media')
                ->description('Atur slug, gambar, jadwal tayang, dan status publish.')
                ->icon('heroicon-o-cog-6-tooth')
                ->schema([
                    // Slug dengan Validasi Unik J.6
                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->minLength(3)
                        ->unique(table: 'posts', ignoreRecord: true)
                        ->helperText('Otomatis terisi dari judul, harus unik & minimal 3 karakter.')
                        ->validationMessages([
                            'min' => 'Slug minimal 3 karakter!',
                        ]),

                    // File Upload dengan Validasi J.6
                    FileUpload::make('image')
                        ->label('Foto Utama')
                        ->image()
                        ->disk('public')
                        ->directory('posts')
                        ->required()
                        ->maxSize(1024)
                        ->helperText('Gambar wajib diupload!')
                        ->validationMessages([
                            'required' => 'Gambar tidak boleh kosong!',
                        ]),

                    // Date Time J.5
                    DateTimePicker::make('published_at')
                        ->label('Jadwal Tayang')
                        ->native(false), // Tampilan kalender lebih bagus

                    // Toggle J.4 & J.5
                    Toggle::make('is_published')
                        ->label('Publish Sekarang')
                        ->onColor('success')
                        ->offColor('danger'),
                ])
                ->columnSpan(1),

        ])->columns(3); // Total grid sistem 3 kolom
    }
}