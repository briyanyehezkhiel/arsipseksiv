<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Get;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function shouldRegisterNavigation(): bool
    {
    return auth()->user()?->role === 'admin';
    }

    public static function getNavigationLabel(): string
    {
        return 'User'; // Label navigasi menjadi singular
    }

    // Mengubah label resource menjadi singular
    public static function getLabel(): string
    {
        return 'User'; // Label resource menjadi singular
    }

    public static function getPluralLabel(): string
    {
        return 'User'; // Bukan Users
    }

    public static function canCreate(): bool
    {
        // if ($record && $record->email === 'admin@gmail.com') {

        //     return false;
        // }
        return auth()->user()?->role === 'admin';


    }

    public static function canEdit(Model $record): bool
    {
        if ($record && $record->email === 'admin@gmail.com') {
            return false;
        }
        return auth()->user()?->role === 'admin';
    }

    public static function canDelete(Model $record): bool
    {
        if ($record && $record->email === 'admin@gmail.com') {
            return false;
        }
        return auth()->user()?->role === 'admin';
    }



    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->required()
                ->email()
                ->maxLength(255),

                TextInput::make('password')
    ->password()
    ->label('Password')
    ->dehydrateStateUsing(function ($state) {
        if (filled($state)) {
            return Hash::make($state);
        }
        return null; // Jangan ubah kalau kosong
    })
    ->dehydrated(fn ($state) => filled($state)) // <-- hanya kirim ke database kalau diisi
    ->maxLength(255)
    ->revealable()
    ->placeholder('Biarkan kosong jika tidak ingin mengubah password')
    ->visible(fn (Get $get, string $operation) => in_array($operation, ['create', 'edit'])),


            Select::make('role')
            ->label('Role')
            ->options([
                'admin' => 'Admin',
                'user' => 'User',
            ])
            ->required(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id'),
            TextColumn::make('name')->searchable(),
            TextColumn::make('email')->searchable(),
            TextColumn::make('role')->searchable(),
            TextColumn::make('created_at')->dateTime(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]) ->label('Lebih Lanjut'), // <-- ganti teks tombol di sini
        ])
        ->searchable();
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
