<?php

namespace App\Providers;


use App\Justification;
use App\Course;
use App\Policies\CoursePolicy;
use App\Policies\UserPolicy;
use App\Policies\JustificationPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
        User::class   => UserPolicy::class,
        Justification::class => JustificationPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
