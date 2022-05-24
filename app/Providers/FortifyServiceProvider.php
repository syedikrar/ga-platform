<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Lockout;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
    
            if ($user &&
                \Hash::check($request->password, $user->password)) {
                    activity()->withProperties(['type' => 'successful-login-attempt','email'=>$request->email])->log('User logged in successfully');
                return $user;
            }
            activity()->withProperties(['type' => 'failed-login-attempt','email'=>$request->email])->log('User login failed');

        });

        RateLimiter::for('login', function (Request $request) {
            $key = 'login.'.$request->email;
            $max = 20;   // attempts
            // $max = env('LOCKOUT_ATTEMPTS',3);   // attempts
            $decay = env('LOCKOUT_TIME',3600);    //seconds
        
            if (RateLimiter::tooManyAttempts($key, $max)) {
                $seconds = RateLimiter::availableIn($key);
                event(new Lockout($request));
                activity()->withProperties(['type' => 'account-lockedout','email'=>$request->email,'ip'=>$request->ip()])->log('Account locked out');
                return redirect()->route('login')
                    ->withErrors(['error' => 'Too many faild attempts. Try again later']);
            } else {
                RateLimiter::hit($key, $decay);
            }
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        Fortify::confirmPasswordView(function () {
            return view('auth.password-confirm');
        });

        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge');
        });

        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });
    }
}
