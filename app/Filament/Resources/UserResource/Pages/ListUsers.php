<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public static ?string $title = 'Daftar User';

    public function mount(): void
    {
        parent::mount();

        if (Auth::check() && Auth::user()->role !== 'admin') {
            $this->redirect('/dashboard'); // tanpa return
        }
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make() ->label('Tambah User'),
        ];
    }
}
