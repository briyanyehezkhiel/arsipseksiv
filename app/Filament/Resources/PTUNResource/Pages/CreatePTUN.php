<?php

namespace App\Filament\Resources\PTUNResource\Pages;

use App\Filament\Resources\PTUNResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreatePTUN extends CreateRecord
{
    protected static string $resource = PTUNResource::class;

    public function mount(): void
    {
        parent::mount();

            if (Auth::check() && Auth::user()->role !== 'admin') {
                $this->redirect('admin/ptuns'); // tanpa return
            }
        }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
