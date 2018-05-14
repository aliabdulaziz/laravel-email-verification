<?php

namespace Aliabdulaziz\LaravelEmailVerification\Observers;

use App\User;
use Illuminate\Support\Facades\Mail;
use Aliabdulaziz\LaravelEmailVerification\Mail\EmailVerification;

class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $token = str_random(32);

        // Add email verification token
        $user->email_verification =  $token;
        $user->save();

        // Send email verification token to user
        Mail::to($user->email)->queue(new EmailVerification($token));
    }
}