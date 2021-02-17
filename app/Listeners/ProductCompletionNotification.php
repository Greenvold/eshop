<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Models\User;
use App\Notifications\NewProductAdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductCompletionNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductCreated  $event
     * @return void
     */
    public function handle(ProductCreated $event)
    {
        (new User)->forceFill([
            'name' => 'Admin Majster',
            'email' => 'admin@test.com',
        ])->notify((new NewProductAdminNotification($event->product))->delay(now()->addMinutes(config('app.product_delay_notification'))));

        info('New product has been created with ID: ' . $event->product);
    }
}