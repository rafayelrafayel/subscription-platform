<?php

namespace App\Jobs;

use App\Mail\SubscriptionEmail;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private Subscriber $subscriber;
    private array $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber, array $data)
    {
        $this->subscriber = $subscriber;
        $this->data = $data;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to($this->subscriber->email)->send(new SubscriptionEmail($this->subscriber, $this->data));
    }
}
