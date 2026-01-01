<?php

namespace App\Filament\Admin\Resources\Stories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class StoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // ImageColumn::make('story_covers')
                //     ->label('صورة الغلاف')
                //     ->disk('public')
                //     ->directory('story_covers')
                //     ->height(80)
                //     ->width(120)
                //     ->rounded(),

                TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('user.name')
                    ->label('الكاتب')
                    ->sortable(),

                BadgeColumn::make('type')
                    ->label('النوع')
                    ->colors([
                        'primary' => 'معاناة',
                        'success' => 'صمود',
                        'warning' => 'أمل',
                        'danger' => 'تحدي',
                    ])
                    ->sortable(),

                TextColumn::make('published_at')
                    ->label('تاريخ النشر')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
