<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\UserMenuItem; // Tambahkan ini di atas bersama use lainnya
use Awcodes\FilamentStickyHeader\StickyHeaderPlugin;
use App\Filament\Widgets\PengendalianChartWidget; // Menambahkan widget grafik


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            // ->plugins([
            //     StickyHeaderPlugin::make()
            //         ->floating(),
            // ])
            ->id('admin')
            ->path('admin')
            ->brandLogo(fn () => view('components.logo-with-text'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([

                // Widgets\AccountWidget::class,
                \App\Filament\Widgets\WelcomeCards::class, // Tambahan custom widget
                PengendalianChartWidget::class, // Menambahkan widget ke dashboard

            ])
            ->userMenuItems([
                UserMenuItem::make()
                    ->label('Profile')
                    ->url('/profile') // Ganti ke URL yang kamu inginkan
                    ->icon('heroicon-o-user-circle')
                    ->visible(fn () => auth()->user()?->email !== 'admin@gmail.com'),

                UserMenuItem::make('logout'), // Ini tombol Sign out
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
