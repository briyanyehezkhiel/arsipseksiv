<?php

namespace App\Filament\Resources\PTUNResource\Pages;

use App\Filament\Resources\PTUNResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PTUNImport;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Actions\CreateAction;
use App\Exports\PTUNExport;


use Filament\Actions\ActionGroup;

class ListPTUNS extends ListRecords
{
    protected static string $resource = PTUNResource::class;

    public static ?string $title = 'Daftar Perkara PTUN';


    protected function getHeaderActions(): array
{
    return [


        ActionGroup::make([
            Action::make('Import CSV')
                ->label('Import CSV')
                ->icon('heroicon-o-arrow-up-tray')
                ->form([
                    FileUpload::make('file')
                        ->label('File CSV')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'text/csv'
                        ])
                        ->required(),
                    TextInput::make('tahun')
                        ->label('Tahun')
                        ->length(4)
                        ->hint(view('components.form-hint-tahun'))
                        ->numeric(),
                ])
                ->action(function (array $data) {
                    try{
                        $filePath = storage_path('app/public/' . $data['file']);
                        $tahun = $data['tahun'];

                        Excel::import(new PTUNImport($tahun), $filePath);

                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Impor data berhasil dilakukan.')
                            ->send();
                    }catch (\Throwable $e) {
                        Notification::make()
                            ->danger()
                            ->title('Gagal Import')
                            ->body($e->getMessage())
                            ->send();
                    }
                })
                ->visible(fn () => auth()->user()?->role === 'admin'),

                Action::make('Export CSV')
                ->label('Export CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    try {
                        $fileName = 'PTUN-export-' . now()->format('Y-m-d') . '.csv';

                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Export CSV berhasil dimulai.')
                            ->send();

                        return response()->streamDownload(function () {
                            echo Excel::raw(new PTUNExport, \Maatwebsite\Excel\Excel::CSV);
                        }, $fileName);
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->danger()
                            ->title('Gagal Export CSV')
                            ->body('Terjadi kesalahan saat mengekspor.')
                            ->send();

                        return null;
                    }
                }),

                Action::make('Export Excel')
                ->label('Export Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    try {
                        $fileName = 'PTUN-export-' . now()->format('Y-m-d') . '.xlsx';

                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Export Excel berhasil dimulai.')
                            ->send();

                        return response()->streamDownload(function () {
                            echo Excel::raw(new PTUNExport, \Maatwebsite\Excel\Excel::XLSX);
                        }, $fileName);
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->danger()
                            ->title('Gagal Export Excel')
                            ->body('Terjadi kesalahan saat mengekspor.')
                            ->send();

                        return null;
                    }
                }),
        ])
        ->label('Transfer Data')
        ->icon('heroicon-o-arrow-down-on-square')
        ->visible(fn () => auth()->user()?->role === 'admin')
        ->button(),

             // Tombol download Excel <2022
             Action::make('file ptun')
             ->label('Lainnya')
             ->url('https://docs.google.com/spreadsheets/d/1Q-L2DzpQvFd-CTS-9oM2pG53Oh6E2dSSSlXWxzUU0Z8/edit?gid=600923734#gid=600923734') // ganti dengan URL file Excel kamu
             ->color('warning')
             ->openUrlInNewTab(),

            // Tombol untuk menambahkan data baru
            Actions\CreateAction::make() ->label('Tambah Perkara PTUN'),

        ];
    }
}
