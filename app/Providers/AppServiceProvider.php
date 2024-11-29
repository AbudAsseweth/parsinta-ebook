<?php

namespace App\Providers;

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\User;
use App\Policies\ArticlePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Model::preventLazyLoading(!app()->isProduction());
        Gate::policy(Article::class, ArticlePolicy::class);

        Blade::directive('hasRole', function (string $role) {
            return "<?php if(auth()->user()->hasRole({$role})): ?>";
        });

        Blade::directive('endHasRole', function () {
            return "<?php endif; ?>";
        });

        Blade::directive("hasAnyRoles", function (string $roles) {
            return "<?php if(auth()->user()->hasAnyRoles($roles)): ?>";
        });

        Blade::directive("endHasAnyRoles", function () {
            return "<?php endif; ?>";
        });

        Gate::before(fn(User $user, string $ability) => $user->isAdmin() ? true : null);

        // Route::bind('article', function (string $value) {
        //     return Article::where('slug', $value)->where('status', ArticleStatus::APPROVED)->firstOrFail();
        // });
    }
}
