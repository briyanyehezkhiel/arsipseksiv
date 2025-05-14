<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PTUNResource\Pages;
use App\Models\PTUN;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Textarea;  // Pastikan ini diimpor

use Filament\Facades\Filament;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\Action;
use App\Imports\PTUNImport;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder; // ✅ Import ini diperlukan




class PTUNResource extends Resource
{
    protected static ?string $model = PTUN::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    // Mengubah label di navigasi menjadi singular
    public static function getNavigationLabel(): string
    {
        return 'Perkara PTUN'; // Label navigasi menjadi singular
    }

    // Mengubah label resource menjadi singular
    public static function getLabel(): string
    {
        return 'Perkara PTUN'; // Label resource menjadi singular
    }

    public static function getPluralLabel(): string
    {
        return 'Perkara PTUN'; // Bukan Perkara PTUNS
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
                Textarea::make('lokus_dan_register_perkara')->label('Lokus dan Register Perkara'),
                Textarea::make('penggugat'),
                Textarea::make('tergugat'),
                Textarea::make('objek_perkara_letak')->label('Objek Perkara/Letak Objek'),
                Textarea::make('tk1'),
                Textarea::make('banding'),
                Textarea::make('kasasi'),
                Textarea::make('pk'),
                Textarea::make('amar_putusan_akhir')->label('Amar Putusan Terakhir'),
                Textarea::make('keterangan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

        //         ->query(function ($query) {
        //     $query->orderBy('created_at', 'desc') // Urutkan berdasarkan created_at terbaru
        ->defaultSort('id', 'desc')        // })

        // ->query(fn () => PTUN::orderByDesc('created_at')->orderBy('id'))

            // ->query(PTUN::query()->latest()) // Ini menambahkan orderBy('created_at', 'desc')

            ->columns([

                TextColumn::make('no')
                ->label('No')
                ->getStateUsing(static function ($record, $rowLoop) {
                    return $rowLoop->iteration;
                })
                ->extraAttributes(['style' => 'width: 50px; text-align: center;']),


                TextColumn::make('tahun')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('lokus_dan_register_perkara')
                    ->label('Lokus dan Register Perkara')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('penggugat')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('tergugat')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('objek_perkara_letak')
                    ->label('Objek Perkara/Letak Objek')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('tk1')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('banding')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('kasasi')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('pk')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('amar_putusan_akhir')
                    ->label('Amar Putusan Terakhir')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 700px; word-wrap: break-word; white-space: normal;']),

                TextColumn::make('keterangan')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                ->visible(fn () => auth()->user()?->role === 'admin'), // hanya admin bisa lihat

            ])
            ->searchable(); // Enable search functionality across all searchable columns
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
            'index' => Pages\ListPTUNS::route('/'),
            'create' => Pages\CreatePTUN::route('/create'),
            'edit' => Pages\EditPTUN::route('/{record}/edit'),
        ];
    }
}
