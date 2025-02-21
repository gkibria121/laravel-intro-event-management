<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\User;
use App\Policies\EventPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('view-event', function (User $user, Event $event) {
            return $event->user_id === $user->id;
        });

        Gate::policy(Event::class, EventPolicy::class);
        RateLimiter::for('event_create', function (Request $request) {
            return Limit::perMinute(3)->by($request->user()?->id ?: $request->ip());
        });
    }
}
