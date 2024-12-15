<?php

namespace App\Providers\Filament;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Forms\Components\FileUpload;
use Filament\Http\Middleware\Authenticate;
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
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->registration()
            ->colors([
                'primary' => '#2d6a4f',
                'success' => Color::Emerald,
                'danger' => Color::Rose,
            ])
            ->font('Nunito', provider: GoogleFontProvider::class)
            ->brandName('İsar Global Yönetim Paneli')
            ->brandLogo(asset('pictures/logo.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,])
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
            ->authGuard('web')
            ->plugins([
                FilamentShieldPlugin::make(),
                   BreezyCore::make()->myProfile(
                       shouldRegisterUserMenu: true, // Kullanıcı menüsünde 'account' linkini etkinleştirir
                       shouldRegisterNavigation: false, // Ana navigasyona My Profile sayfası eklemez
                       navigationGroup: 'Settings', // Navigasyon grubunu ayarlar
                       hasAvatars: true, // Avatar yükleme form bileşenini etkinleştirir
                       slug: 'my-profile' // Profil sayfası için slug ayarlar
                   )->avatarUploadComponent(function () {
                       return FileUpload::make('avatar_url');
                   })->passwordUpdateRules(
                       rules: [
                           Password::default()->mixedCase()->uncompromised(3)
                       ], // Veya dilediğiniz başka doğrulama kurallarını ekleyebilirsiniz
                       requiresCurrentPassword: true // Mevcut şifreyi gerektirir
                   )->enableTwoFactorAuthentication(
                       force: false, // Kullanıcıya 2FA’yı zorunlu kılar mı?

                   )->enableSanctumTokens(
                       permissions: ['create', 'view', 'update', 'delete'] // İsteğe bağlı olarak izinleri özelleştirin
                   ),

            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
