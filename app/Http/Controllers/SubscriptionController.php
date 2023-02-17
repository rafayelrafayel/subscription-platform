<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Jobs\SendSubscriptionEmail;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $subscriber = Subscriber::create([
            'email' => $request->input('email'),
            'website_id' => $request->input('website_id')
        ]);

        if ($subscriber) {

            return response()->json([
                'success' => true,
                'message' => 'User subscribed successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User subscription failed'
            ]);
        }
    }
}
