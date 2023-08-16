<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Enums\TokenAbilityEnum;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Passport::tokensCan([
            TokenAbilityEnum::OtpVerify => 'Verify pin code',
            TokenAbilityEnum::AuthorizedToken => 'Authorized token request',
            TokenAbilityEnum::ResetOtpVerify => 'Verify otp request from reset password',
        ]);
    }
}
