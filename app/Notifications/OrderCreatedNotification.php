<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    public $order;
    
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'pusher'];
        $channels = ['database'];
        //notification_preferences=name of notification
        if ($notifiable->notification_preferences['OrderCreated']['sms'] ?? false) {
            $channels[] = 'vonage';
        }
        if ($notifiable->notification_preferences['OrderCreated']['mail'] ?? false) {
            $channels[] = 'mail';
        }
        if ($notifiable->notification_preferences['OrderCreated']['broadcast'] ?? false) {
            $channels[] = 'broadcast';
        }
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $addr = $this->order->billingAddress;
        return (new MailMessage)
            ->subject("New Order # . {$this->order->number}")
            ->line("A new order (#{$this->order->number}) created by{$addr->country_name}.")
            ->action('Notification Action', url('/welcome'))
            ->line('Thank you for using our application!');
    }
    public function toDatabase($notifiable)
    {
        $addr = $this->order->billingAddress;
        return [
            'body' => ("A new order (#{$this->order->number}) created by{$addr->country_name}."),
            'icon' => 'fas fa-file',
            'url' => url('/welcome'),
            'order_id' => $this->order->id
        ];
    }
    public function toBroadcast($notifiable)
    {
        $addr = $this->order->billingAddress;
        return new BroadcastMessage([
            'body' => ("A new order (#{$this->order->number}) created by{$addr->country_name}."),
            'icon' => 'fas fa-file',
            'url' => url('/welcome'),
            'order_id' => $this->order->id
        ]);
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}