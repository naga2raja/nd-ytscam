<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\UserSubscription;
use App\Models\SubscriptionPlan;

class SubscriptionController extends Controller
{
    public function subscribeNow(Request $Request, $planId)
    {
    	//disable previous plans
    	UserSubscription::where('user_id', Auth::user()->id)->update(['status' => 0]);

    	//create subscription Plan
        $userSubscription = new UserSubscription;
        $userSubscription->user_id = Auth::user()->id;
        $userSubscription->subscription_id = $planId;
        $userSubscription->status = 1; // Active
        $userSubscription->save();

        $subscriptionPlan = SubscriptionPlan::where('id', $planId)->first();
        Session::put('subscription_plan', $subscriptionPlan->name);

        // dd('subscribed successfully');
        return view('subscribe/success');
    	
    }
}
