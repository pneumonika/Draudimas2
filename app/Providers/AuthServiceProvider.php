<?php

namespace App\Providers;

 use App\Models\User;
 use Illuminate\Support\Facades\Gate;
use App\Models\Car;
use App\Models\Owner;
use App\Policies\CarPolicy;
use App\Policies\OwnerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Owner::class=>OwnerPolicy::class,
        Car::class=>CarPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-image',function (User $user, Car $car){

            return ($user->permission == 3) || ($user->id == $car->owner->user_id);
        });
    }
}
