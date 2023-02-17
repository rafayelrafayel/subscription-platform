<?php

namespace App\Console\Commands;

use App\Jobs\SendSubscriptionEmail;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Console\Command;

class SendPostNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:send-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications to subscribers for new posts.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $websites = Website::all();

        foreach ($websites as $website) {
            $latestPost = Post::where('website_id', $website->id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($latestPost) {
                $subscriptions = Subscriber::where('website_id', $website->id)->get();

                foreach ($subscriptions as $subscription) {
                    $sentPosts = json_decode($subscription->sent_posts) ?? [];

                    if (!in_array($latestPost->id, $sentPosts)) {
                        // send email to subscriber with post details
                        $data = [
                            'title' => $latestPost->title,
                            'description' => $latestPost->description,
                        ];

                        dispatch(new SendSubscriptionEmail($subscription, $data));
                       // Mail::to($subscription->email)->send(new NewPostEmail($data));

                        // add the sent post to the subscription's sent_posts array
                        $sentPosts[] = $latestPost->id;
                        $subscription->sent_posts = json_encode($sentPosts);
                        $subscription->save();
                    }
                }
            }
        }
    }
}
