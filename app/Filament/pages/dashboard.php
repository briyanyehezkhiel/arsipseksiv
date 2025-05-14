<?php

use Illuminate\Support\Facades\Auth;
use Filament\Pages\Page;

class Dashboard extends Page
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Mengarah ke halaman login dari Breeze
    }
}
