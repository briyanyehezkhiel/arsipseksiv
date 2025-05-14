<?php

namespace App\Filament\Resources\PengendalianResource\Pages;

use App\Filament\Resources\PengendalianResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePengendalian extends CreateRecord
{
    protected static string $resource = PengendalianResource::class;

    public function mount(): void
    {
        parent::mount();

            if (Auth::check() && Auth::user()->role !== 'admin') {
                $this->redirect('admin/pengendalians'); // tanpa return
            }
        }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
