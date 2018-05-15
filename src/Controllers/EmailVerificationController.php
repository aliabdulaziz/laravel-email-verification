<?php

namespace Aliabdulaziz\LaravelEmailVerification\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Mail;
use Aliabdulaziz\LaravelEmailVerification\Mail\EmailVerification;

class EmailVerificationController extends Controller
{
    /**
     * Show email verification page
     *
     * @return \Illuminate\Http\Response
     */
    public function show($status = null)
    {
        if (auth()->check()) {

            $user = auth()->user();

            if ($user->email_verification) {
                $type       = 'danger';
                $title      = 'Your email is not verified!';
                $message    = 'Please verify your email address.';
            } else {
                $type       = 'success';
                $title      = 'Your email is verified!';
                $message    = 'Thank your for choosing '. config('app.name', 'Laravel') . '.';
            }

            if ($status) {
                dd($status);
            }

            return view('laravelemailverification::verifications.email.show', [
                'status' => [
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                ],
                'email' => $user->email,
            ]);
        }

        return redirect('/login');     
    }

    /**
     * Verify user email
     *
     * @param  string $token
     * @return \Illuminate\Http\Response
     */
    public function verify($token)
    {
        if (auth()->check()) {

            $user = auth()->user();

            if ($user->email_verification) {
                if ($user->email_verification === $token) { 
                    $user->email_verification = null;
                    $user->save();
                } else {
                    $type       = 'danger';
                    $title      = 'Email verification failed!';
                    $message    = 'The verification code does not match our record.';

                    return view('laravelemailverification::verifications.email.show', [
                        'status' => [
                            'type' => $type,
                            'title' => $title,
                            'message' => $message,
                        ],
                        'email' => $user->email,
                    ]);
                }
            }

            return $this->show();
        }

        return redirect('/login');
    }

    /**
     * Resend email verification mail
     *
     * @return \Illuminate\Http\Response
     */
    public function resend()
    {
        if (auth()->check()) {

            $user = auth()->user();

            // Send email verification token to user
            Mail::to($user->email)->queue(new EmailVerification($user->email_verification));

            $type       = 'success';
            $title      = 'Mail has been sent!';
            $message    = 'New email verification mail has been sent to '. $user->email.'.';

            return redirect('email/verification')
                    ->with('status', [
                        'type' => $type,
                        'title' => $title,
                        'message' => $message,
                    ]);
        }

        return redirect('/login');
    }
}
