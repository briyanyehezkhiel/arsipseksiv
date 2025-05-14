<?php

namespace App\Filament\Resources\SengketaResource\Pages;

use App\Filament\Resources\SengketaResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateSengketa extends CreateRecord
{
    protected static string $resource = SengketaResource::class;

    public function mount(): void
    {
        parent::mount();

            if (Auth::check() && Auth::user()->role !== 'admin') {
                $this->redirect('/dashboard'); // tanpa return
            }
        }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
