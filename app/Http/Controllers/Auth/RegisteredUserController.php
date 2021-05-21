<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\SubscriptionPlan;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Session;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */

    public function loginWithGoogle(Request $request)
    {
        
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        $accessToken = $user->token;
        session(['access_token' => $accessToken]);
        if($existingUser){
            // log them in            
            auth()->login($existingUser, true);
            $userSubscription = UserSubscription::where('user_id', $existingUser->id)->where('status', 1)->first();
            $subscription_id = $userSubscription->subscription_id;
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->password        = Hash::make('dummy@321');
            // $newUser->avatar_original = $user->avatar_original;
            $newUser->save();            
            auth()->login($newUser, true);

            //create Default subscription Plan
            $subscription_id = 1;
            $userSubscription = new UserSubscription;
            $userSubscription->user_id = $newUser->id;
            $userSubscription->subscription_id = $subscription_id; //Free
            $userSubscription->status = 1; // Active
            $userSubscription->save();    

        }      

        $subscriptionPlan = SubscriptionPlan::where('id', $subscription_id)->first();
        Session::put('subscription_plan', $subscriptionPlan->name);

        return redirect('video');
        // return redirect(RouteServiceProvider::HOME);
        
    }
}
