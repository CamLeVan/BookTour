<?php

namespace App\Providers;

use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

class EventServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Event::listen(Failed::class, function ($event) {
            Log::channel('auth')->warning('Login Failed', [
                'email' => $event->credentials['email'],
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
        });

        Event::listen(Login::class, function ($event) {
            Log::channel('auth')->info('User Logged In', [
                'user_id' => $event->user->id,
                'email' => $event->user->email,
                'ip' => request()->ip()
            ]);
        });
    }
} 