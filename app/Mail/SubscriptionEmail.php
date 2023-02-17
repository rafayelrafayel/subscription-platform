<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionEmail extends Mailable
{
    use Queueable, SerializesModels;
    private Subscriber $subscriber;
    private array $data;
    public function __construct(Subscriber $subscriber, array $data)
    {
        $this->subscriber = $subscriber;
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('email', ['user' => $this->subscriber, 'data' => $this->data])
            ->subject('Thank you for subscribing!');
    }
}
