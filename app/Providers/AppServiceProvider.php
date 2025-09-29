<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use App\Models\WorkOrder;

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
        // Paksa HTTPS jika APP_URL menggunakan skema https
        $appUrl = (string) config('app.url');
        if (function_exists('str_starts_with') && str_starts_with($appUrl, 'https://')) {
            URL::forceScheme('https');
        }

        Paginator::useBootstrap();

        // Provide a Laravel 8-compatible @vite directive
        Blade::directive('vite', function ($expression) {
            return "<?php echo \\App\\Providers\\AppServiceProvider::renderViteAssets($expression); ?>";
        });

        // Share latest work order globally with public layout
        View::composer('layouts.public', function ($view) {
            $latestWorkOrder = WorkOrder::latest()->first();
            $view->with('latestWorkOrder', $latestWorkOrder);
        });
    }

    /**
     * Render Vite assets for dev (HMR) and production (manifest) environments.
     * Usage: @vite(['resources/css/app.css','resources/js/app.js'])
     */
    public static function renderViteAssets($assets): HtmlString
    {
        // Blade passes array literal as string; evaluate into array
        if (!is_array($assets)) {
            $assets = eval('return ' . $assets . ';');
        }

        $isLocal = app()->environment('local');
        $devHost = env('VITE_DEV_SERVER', 'http://localhost:5173');
        $html = '';

        if ($isLocal) {
            // HMR client
            $html .= '<script type="module" src="' . $devHost . '/@vite/client"></script>';
            foreach ($assets as $asset) {
                $assetPath = ltrim($asset, '/');
                if (substr($assetPath, -4) === '.css') {
                    // Important: use ?direct so Vite serves plain CSS instead of JS-injected CSS
                    $html .= '<link rel="stylesheet" href="' . $devHost . '/' . $assetPath . '?direct">';
                } else {
                    $html .= '<script type="module" src="' . $devHost . '/' . $assetPath . '"></script>';
                }
            }
            return new HtmlString($html);
        }

        // Production: read Vite manifest
        $manifestPath = public_path('build/manifest.json');
        if (!File::exists($manifestPath)) {
            return new HtmlString('<!-- Vite manifest not found. Run npm run build. -->');
        }
        $manifest = json_decode(File::get($manifestPath), true) ?: [];

        foreach ($assets as $asset) {
            if (!isset($manifest[$asset])) {
                continue;
            }
            $entry = $manifest[$asset];
            if (!empty($entry['css']) && is_array($entry['css'])) {
                foreach ($entry['css'] as $cssFile) {
                    $html .= '<link rel="stylesheet" href="' . asset('build/' . $cssFile) . '">';
                }
            }
            if (!empty($entry['file'])) {
                $html .= '<script type="module" src="' . asset('build/' . $entry['file']) . '"></script>';
            }
        }

        return new HtmlString($html);
    }
}
