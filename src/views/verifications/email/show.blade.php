@extends('laravelemailverification::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Email Verification</h3></div>

                <div class="card-body">

                    @if(session('status'))
                        <div class="alert alert-{{ session('status')['type'] }}">
                            <h4><strong>{{ session('status')['title'] }}<strong></h4>
                            <div>{{ session('status')['message'] }}</div>
                        </div>
                        <p>If you cannot find the <i><u>email verification</u></i> mail in the Index folder, please check the Junk/Spam folder.</p>
                    @else
                        <div class="alert alert-{{ $status['type'] }}">
                            <h4><strong>{{ $status['title'] }}<strong></h4>
                            <div>{{ $status['message'] }}</div>
                        </div>

                        @if($status['type'] === 'danger')

                            @if($status['title'] === 'Email verification failed!')
                            <p>Please try again, or click on the reset button to receive a new verification mail.</p>
                            @else
                            <p>We have sent the verification mail to <span class="text-primary">{{ $email }}</span>. If you cannot find the <i><u>email verification</u></i> mail in the Index folder, please check the Junk/Spam folder.</p>
                            <p>If you did not receive the <i><u>email verification</u></i> mail please click on the resend button.</p>
                            @endif

                            <div class="text-center">
                                <form method="POST" action="{{ url('email/verification/resend') }}">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-primary" value="Resend Verification Mail">
                                </form>
                                
                            </div>
                            
                        @else

                            @if($status['title'] === 'Mail has been sent!')
                            <p>If you cannot find the <i><u>email verification</u></i> mail in the Index folder, please check the Junk/Spam folder.</p>
                            @else
                            <p>Your email <span class="text-primary">{{ $email }}</span> has been verified successfully.</p>
                            @endif

                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
