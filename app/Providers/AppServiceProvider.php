<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use App\Services\Payment\CashService;
use App\Services\Payment\PayPalService;
use App\Services\Payment\StripeService;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Front\FrontController;
use App\Services\Payment\PaymentMethodInterface;
use App\Http\Controllers\Front\PaymentController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Default binding
        $this->app->bind(PaymentMethodInterface::class, PayPalService::class);

        // Contextual binding based on payment method
        $this->app->when(PaymentController::class)
            ->needs(PaymentMethodInterface::class)
            ->give(function ($app) {
                $request = $app->make('request');
                $paymentMethod = $request->input('payment_method') ?? session('payment_method');
                switch ($paymentMethod) {
                    case 'PayPal':
                        return new PayPalService;
                    case 'Stripe':
                        return new StripeService;
                    case 'Cash':
                        return new CashService;
                    default:
                        throw new \InvalidArgumentException("Invalid payment method: {$paymentMethod}");
                }
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
