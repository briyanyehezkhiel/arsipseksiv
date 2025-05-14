<?php

namespace App\Filament\Resources\PNResource\Pages;

use App\Filament\Resources\PNResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditPN extends EditRecord
{
    protected static string $resource = PNResource::class;

    public function mount(string|int $record): void
    {
        parent::mount($record);

            if (Auth::check() && Auth::user()->role !== 'admin') {
                $this->redirect('admin/pns'); // tanpa return
            }
        }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
