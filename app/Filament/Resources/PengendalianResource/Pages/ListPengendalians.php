<?php

namespace App\Filament\Resources\PengendalianResource\Pages;

use Filament\Actions;
use Filament\Actions\ActionGroup;
use Filament\Pages\Actions\Action;
use App\Exports\PengendalianExport;
use App\Imports\PengendalianImport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use OpenSpout\Common\Helper\Escaper\XLSX;

use App\Filament\Resources\PengendalianResource;
use Filament\Resources\Pages\Actions\CreateAction;



class ListPengendalians extends ListRecords
{
    protected static string $resource = PengendalianResource::class;

    public static ?string $title = 'Daftar Pengendalian';


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
                    try {
                        $filePath = storage_path('app/public/' . $data['file']);
                        $tahun = $data['tahun'];

                        Excel::import(new PengendalianImport($tahun), $filePath);

                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Impor data berhasil dilakukan.')
                            ->send();
                    } catch (\Throwable $e) {
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
                        $fileName = 'Pengendalian-export-' . now()->format('Y-m-d') . '.csv';

                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Export CSV berhasil dimulai.')
                            ->send();

                        return response()->streamDownload(function () {
                            echo Excel::raw(new PengendalianExport, \Maatwebsite\Excel\Excel::CSV);
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
                        $fileName = 'Pengendalian-export-' . now()->format('Y-m-d') . '.xlsx';

                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Export Excel berhasil dimulai.')
                            ->send();

                        return response()->streamDownload(function () {
                            echo Excel::raw(new PengendalianExport, \Maatwebsite\Excel\Excel::XLSX);
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


        Action::make('<2022')
            ->label('Lainnya')
            ->url('https://docs.google.com/spreadsheets/d/14bHtERkRhppReeCoIFL_dAAN-c4WmN6TFb8UT6IRyEY/edit?gid=0#gid=0')
            ->color('warning')
            ->openUrlInNewTab(),

        Actions\CreateAction::make()->label('Tambah Pengendalian'),


    ];
}

}
