<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PNResource\Pages;
use App\Filament\Resources\PNResource\RelationManagers;
use App\Models\PN;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Textarea;  // Pastikan ini diimpor

use Filament\Tables\Actions\Action;
use Filament\Forms\Components\FileUpload;
use App\Imports\PNImport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;


class PNResource extends Resource
{
    protected static ?string $model = PN::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';


    // Mengubah label di navigasi menjadi singular
    public static function getNavigationLabel(): string
    {
        return 'Perkara PN '; // Label navigasi menjadi singular
    }

    // Mengubah label resource menjadi singular
    public static function getLabel(): string
    {
        return 'Perkara PN '; // Label resource menjadi singular
    }

    public static function getPluralLabel(): string
    {
        return 'Perkara PN '; // Bukan Perkara PN s
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->role === 'admin';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tahun')
                    ->required()
                    ->Length(4)
                    ->numeric(),
                Textarea::make('no_register_perkara'),
                Textarea::make('penggugat'),
                Textarea::make('tergugat'),
                Textarea::make('objek_perkara'),
                Textarea::make('tk1'),
                Textarea::make('banding'),
                Textarea::make('kasasi'),
                Textarea::make('pk'),
                Textarea::make('tipologi_kasus'),
                Textarea::make('menang'),
                Textarea::make('kalah'),
                Textarea::make('keterangan'),
                Textarea::make('justicia'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->query(fn () => PN::orderByDesc('created_at')->orderBy('id'))

            // ->query(PN::query()->latest()) // Ini menambahkan orderBy('created_at', 'desc')

            ->defaultSort('id', 'desc')        // })

            ->columns([

                TextColumn::make('no')
                ->label('No')
                ->getStateUsing(static function ($record, $rowLoop) {
                    return $rowLoop->iteration;
                })
                ->extraAttributes(['style' => 'width: 50px; text-align: center;']),


                TextColumn::make('tahun')
                    ->label('Tahun')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),

                TextColumn::make('no_register_perkara')
                    ->label('No. Register Perkara')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('penggugat')
                    ->label('Penggugat')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),

                TextColumn::make('tergugat')
                    ->label('Tergugat')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 700px; word-wrap: break-word; white-space: normal;']),

                TextColumn::make('objek_perkara')
                    ->label('Objek Perkara')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('tk1')
                    ->label('TK1')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('banding')
                    ->label('Banding')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('kasasi')
                    ->label('Kasasi')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('pk')
                    ->label('PK')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('tipologi_kasus')
                    ->label('Tipologi Kasus')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('menang')
                    ->label('Menang')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('kalah')
                    ->label('Kalah')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->sortable()
                    ->wrap()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('justicia')
                    ->label('Justicia')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                ->visible(fn () => auth()->user()?->role === 'admin'), // hanya admin bisa lihat

            ])
            ->filters([
                //
            ])
            // Enable search functionality by using the `searchable` method.
            ->searchable(); // This enables the global search bar for all the searchable columns
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
            'index' => Pages\ListPNS::route('/'),
            'create' => Pages\CreatePN::route('/create'),
            'edit' => Pages\EditPN::route('/{record}/edit'),
        ];
    }
}
