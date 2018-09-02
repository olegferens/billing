<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class SubscriptionsController extends Controller
{
    //
    public function store(Request $request)
    {
          // get the plan after submitting the form
          $plan = Plan::findOrFail($request->plan);

          // subscribe the user
          $request->user()->newSubscription('main', $plan->braintree_plan)->create($request->payment_method_nonce);
/*
Once we get the plan, we call the newSubscription method on the currently logged in user. 
This method came with the Billable trait that we required in the User model. 
The first argument passed to the newSubscription method should be the name of the subscription. 
For this app, we only offer monthly subscriptions and thus called our subscription main. 
The second argument is the specific Braintree plan the user is subscribing to.

*/

          // redirect to home after a successful subscription
          return redirect('home');
    }
}
