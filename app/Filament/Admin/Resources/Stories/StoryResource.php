<?php

namespace App\Filament\Admin\Resources\Stories;

use App\Filament\Admin\Resources\Stories\Pages\CreateStory;
use App\Filament\Admin\Resources\Stories\Pages\EditStory;
use App\Filament\Admin\Resources\Stories\Pages\ListStories;
use App\Filament\Admin\Resources\Stories\Schemas\StoryForm;
use App\Filament\Admin\Resources\Stories\Tables\StoriesTable;
use App\Models\Story;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class StoryResource extends Resource
{
    protected static ?string $model = Story::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // Arabic labels
    protected static ?string $navigationLabel = 'القصص';
    protected static ?string $pluralModelLabel = 'القصص';
    protected static ?string $modelLabel = 'قصة';
    protected static string|UnitEnum|null $navigationGroup = 'لوحة الإدارة';

    public static function form(Schema $schema): Schema
    {
        return StoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStories::route('/'),
            'create' => CreateStory::route('/create'),
            'edit' => EditStory::route('/{record}/edit'),
        ];
    }
}
