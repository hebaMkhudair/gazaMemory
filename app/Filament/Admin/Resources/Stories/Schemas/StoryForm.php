<?php

namespace App\Filament\Admin\Resources\Stories\Schemas;

use App\Models\User;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('العنوان')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('الـ slug')
                    ->maxLength(255)
                    ->nullable(),

                BelongsToSelect::make('user_id')
                    ->relationship('user', 'name')
                    ->label('الكاتب')
                    ->required(),

                Select::make('type')
                    ->label('النوع')
                    ->options([
                        'suffering' => 'معاناة',
                        'resilience' => 'صمود',
                        'hope' => 'أمل',
                        'challenge' => 'تحدي',
                        'heritage' => 'تراث',
                    ])
                    ->nullable(),

                RichEditor::make('content')
                    ->label('المحتوى')
                    ->required(),

                FileUpload::make('cover_image')
                    ->label('صورة الغلاف')
                    ->image()
                    ->disk('public')
                    ->directory('story_covers')
                    ->nullable(),

                DateTimePicker::make('published_at')
                    ->label('تاريخ النشر')
                    ->nullable(),
            ]);
    }
}
