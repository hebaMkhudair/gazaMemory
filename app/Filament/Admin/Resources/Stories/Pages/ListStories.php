<?php

namespace App\Filament\Admin\Resources\Stories\Pages;

use App\Filament\Admin\Resources\Stories\StoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStories extends ListRecords
{
    protected static string $resource = StoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
