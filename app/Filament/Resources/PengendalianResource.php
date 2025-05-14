<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengendalianResource\Pages;
use App\Models\Pengendalian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;

use Filament\Tables\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PengendalianImport;
use Filament\Notifications\Notification;

class PengendalianResource extends Resource
{
    protected static ?string $model = Pengendalian::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    // Mengubah label di navigasi menjadi singular
    public static function getNavigationLabel(): string
    {
        return 'Pengendalian'; // Label navigasi menjadi singular
    }

    // Mengubah label resource menjadi singular
    public static function getLabel(): string
    {
        return 'Pengendalian'; // Label resource menjadi singular
    }

    public static function getPluralLabel(): string
    {
        return 'Pengendalian'; // Bukan Pengendalians
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

                Select::make('jenis_hak')
                    ->options([
                        'Hak Milik' => 'HM',
                        'Hak Guna Usaha' => 'HGU',
                        'Hak Pakai' => 'HP',
                        'Hak Guna Bangunan' => 'HGB',
                    ])
                    ->searchable(),

                Textarea::make('nomor')
                    ->numeric(),

                DatePicker::make('tanggal_terbit')
                    ->after(fn($get) => $get('tanggal_berakhir') && $get('tanggal_terbit') >= $get('tanggal_berakhir') ? 'Tanggal Terbit harus lebih kecil dari Tanggal Berakhir' : null), // Validasi tanggal_terbit sebelum tanggal_berakhir

                DatePicker::make('tanggal_berakhir')
                    ->before(fn($get) => $get('tanggal_terbit') && $get('tanggal_berakhir') <= $get('tanggal_terbit') ? 'Tanggal Berakhir harus lebih besar dari Tanggal Terbit' : null), // Validasi tanggal_berakhir setelah tanggal_terbit


                Textarea::make('kota'),

                Textarea::make('kecamatan'),

                Textarea::make('kelurahan'),

                TextInput::make('luas_hak')
                    ->suffix(' m²'),

                Textarea::make('penguasaan_tanah'),

                Textarea::make('penggunaan_tanah'),

                Textarea::make('pemanfaatan_tanah'),

                TextInput::make('terindikasi_terlantar')
                    ->suffix('m²'),

                Textarea::make('keterangan')
                    ->rows(3)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->query(fn () => Pengendalian::orderByDesc('created_at')->orderBy('id'))

            // ->query(Pengendalian::query()->latest()) // Ini menambahkan orderBy('created_at', 'desc')

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


                TextColumn::make('jenis_hak')
                    ->label('Jenis Hak')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('nomor')
                    ->label('Nomor')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('tanggal_terbit')
                    ->label('Tanggal Terbit')
                    ->date()
                    ->sortable()
                    ->extraAttributes(['style' => 'width: 150px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('tanggal_berakhir')
                    ->label('Tanggal Berakhir')
                    ->date()
                    ->sortable()
                    ->extraAttributes(['style' => 'width: 150px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('kota')
                    ->label('Kota')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('kecamatan')
                    ->label('Kecamatan')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('kelurahan')
                    ->label('Kelurahan')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('luas_hak')
                    ->label('Luas Hak')
                    ->suffix(' m²')
                    ->sortable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('penguasaan_tanah')
                    ->label('Penguasaan Tanah')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('penggunaan_tanah')
                    ->label('Penggunaan Tanah')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('pemanfaatan_tanah')
                    ->label('Pemanfaatan Tanah')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('terindikasi_terlantar')
                    ->label('Terindikasi Terlantar')
                    ->suffix('m²')
                    ->sortable()
                    ->extraAttributes(['style' => 'width: 100px; word-wrap: break-word; white-space: normal;']),


                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->sortable()
                    ->extraAttributes(['style' => 'width: 300px; word-wrap: break-word; white-space: normal;']),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                ->visible(fn () => auth()->user()?->role === 'admin'), // hanya admin bisa lihat
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengendalians::route('/'),
            'create' => Pages\CreatePengendalian::route('/create'),
            'edit' => Pages\EditPengendalian::route('/{record}/edit'),
        ];
    }
}
