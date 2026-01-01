<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Password;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الاسم')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required()
                    ->unique(User::class, 'email'),

                Password::make('password')
                    ->label('كلمة المرور')
                    ->minLength(8)
                    ->required(fn ($livewire, $context) => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => $state ?: null),

                FileUpload::make('avatar')
                    ->label('الصورة')
                    ->image()
                    ->directory('avatars')
                    ->disk('public')
                    ->nullable(),

                Textarea::make('bio')
                    ->label('نبذة')
                    ->rows(3)
                    ->maxLength(500)
                    ->nullable(),
            ]);
    }
}
