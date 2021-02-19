<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Notifications\NewProductAdminNotification;
use Illuminate\Support\Facades\Notification;

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
        Notification::route('mail', 'admin@test.com')
            ->notify((new NewProductAdminNotification($event->product))->delay(now()->addMinutes(config('app.product_delay_notification'))));

        info('New product has been created with ID: ' . $event->product->id);
    }
}