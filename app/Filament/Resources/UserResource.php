<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Kullanıcı İşlemleri';


    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Kullanıcılar';
    protected static ?string $pluralLabel = 'Kullanıcılar';
    protected static ?string $label = 'Kullanıcı';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('İsim')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('E-posta')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(User::class, 'email', ignoreRecord: true),

                Forms\Components\TextInput::make('password')
                    ->label('Şifre')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->same('password_confirmation'),

                Forms\Components\TextInput::make('password_confirmation')
                    ->label('Şifre Doğrulama')
                    ->password()
                    ->required()
                    ->minLength(8),

                Forms\Components\Select::make('roles')
                    ->label('Roller')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'Kullanıcı',
                    ])
                    ->multiple()
                    ->preload()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('İsim')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('E-posta')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma Tarihi')
                    ->dateTime()
                    ->sortable(),

                BadgeColumn::make('roles.name')
                    ->label('Roller')
                    ->colors([
                        'success' => fn ($state) => $state === 'admin',
                        'primary' => fn ($state) => $state === 'user',
                    ])
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                // Filtreler buraya eklenebilir
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // İlişkiler buraya eklenecek
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
