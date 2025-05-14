<?php

namespace App\Filament\Resources\PNResource\Pages;

use App\Filament\Resources\PNResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePN extends CreateRecord
{
    protected static string $resource = PNResource::class;

    public function mount(): void
    {
        parent::mount();

            if (Auth::check() && Auth::user()->role !== 'admin') {
                $this->redirect('admin/pns'); // tanpa return
            }
        }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
