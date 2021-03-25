<?php

namespace App\Notifications;

use App\Models\Offer;
use FontLib\Table\Type\post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferStore extends Notification
{
    use Queueable;

    protected $offer;
    public function __construct(Offer $offer)
    {
       $this->offer = $offer;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'data' => 'يوجد إشعار' .$this->offer->name."بواسطة <br>".auth()->user()->name
        ];
    }
}
