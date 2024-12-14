<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Kullanıcı Yönetimi';

    protected static ?string $navigationIcon = 'far-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Kullanıcının İsmi')
                    ->required()
                    ->placeholder('Kullanıcının İsmi'),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->placeholder('E-Mail Adresiniz'),
                Forms\Components\TextInput::make('password')->required()->label('Şifreniz'),
                Forms\Components\Select::make('roles')
                    ->label('Roller')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->multiple()
                    ->required()
                    ->placeholder('Rolleri Tanımlayın'),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()->copyable()->copyMessage('Email Kopyalandı'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('password')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roles.name')->badge()
                    ->color(fn (string $state): string => match ($state) {
                    'Muhasebe' => 'gray',
                    'Giriş' => 'warning',
                    'Talabe Görevlisi' => 'success',
                    'Admin' => 'danger',
                        'super_admin' => 'red',
                        'panel_user' => 'blue',
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
