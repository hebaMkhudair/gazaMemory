<?php

namespace App\Filament\Admin\Resources\Stories\Pages;

use App\Filament\Admin\Resources\Stories\StoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStory extends CreateRecord
{
    protected static string $resource = StoryResource::class;
}
