<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Card;
use App\Models\Column;
use App\Models\Comment;
use App\Models\User;
use App\Policies\CardPolicy;
use App\Policies\ColumnPolicy;
use App\Policies\CommentPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Column::class => ColumnPolicy::class,
        Card::class => CardPolicy::class,
        Comment::class => CommentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}