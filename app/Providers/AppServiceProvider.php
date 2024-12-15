<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Support\ServiceProvider;
use App\Models\Permission;
use App\Models\Role;
use BezhanSalleh\FilamentLanguageSwitch\Enums\Placement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar','en','fr','tr','de'])
                ->visible(outsidePanels: true)  ->outsidePanelPlacement(Placement::BottomRight)
                ->flags([
                    'ar' => asset('flags/saudi-arabia.png'),
                    'fr' => asset('flags/france.png'),
                    'en' => asset('flags/usa.png'),
                    'tr' => asset('flags/turkey.png'),
                    'de' => asset('flags/germany.png'),
                ])
            ; // also accepts a closure
        });

    }
}
