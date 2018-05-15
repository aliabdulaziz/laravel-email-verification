<?php

Route::middleware(['web', 'auth'])->group(function () {

	Route::get('email/verification', 'Aliabdulaziz\LaravelEmailVerification\Controllers\EmailVerificationController@show');
	Route::get('email/verification/{token}', 'Aliabdulaziz\LaravelEmailVerification\Controllers\EmailVerificationController@verify');
	Route::post('email/verification/resend', 'Aliabdulaziz\LaravelEmailVerification\Controllers\EmailVerificationController@resend');

});