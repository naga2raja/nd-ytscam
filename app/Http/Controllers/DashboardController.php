<?php

namespace App\Http\Controllers;
use App\Models\YoutubeApiRequest;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use App\Models\UserSpamWord;

use Illuminate\Http\Request;
use Auth;
use Session;
use Google_Client;
use Google_Service_YouTube;

class DashboardController extends Controller
{
    public function index()
    {	
    	$deletedCount = YoutubeApiRequest::where('user_id', Auth::user()->id)
    				->selectRaw('COUNT(*) as del_count')
    				->where('api_type', 'delete')
    				->first();
    	$deletedCommentsCount = $deletedCount->del_count; 

    	$subscriptionPlans = SubscriptionPlan::get();

    	$currentPlan = UserSubscription::join('subscription_plans', 'subscription_plans.id', '=', 'user_subscriptions.subscription_id')
    			->where('user_id', Auth::user()->id)
    			->where('status', 1)
    			->selectRaw('subscription_plans.name as plan, user_subscriptions.status, subscription_plans.id as plan_id, subscription_plans.delete_comments_count  ')
    			->first();
    	// dd($currentPlan);

    	return view('dashboard', compact('deletedCommentsCount', 'subscriptionPlans', 'currentPlan'));
    }
}
