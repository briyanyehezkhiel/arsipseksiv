<?php

namespace App\Filament\Resources\PTUNResource\Pages;

use App\Filament\Resources\PTUNResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditPTUN extends EditRecord
{
    protected static string $resource = PTUNResource::class;

    public function mount(string|int $record): void
    {
        parent::mount($record);

            if (Auth::check() && Auth::user()->role !== 'admin') {
                $this->redirect('admin/ptuns'); // tanpa return
            }
        }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
