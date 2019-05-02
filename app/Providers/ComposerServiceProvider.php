<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        view()->composer('', function () {
//
//        });

        // userList
        view()->composer(array('approval.approversettings.create', 'approval.approversettings.edit',
            'teaching.teachingadministrator.create', 'teaching.teachingadministrator.edit', 'purchase.payments.create_hxold',
            'changeuser'), function($view) {
            $view->with('userList', \App\User::where('email', '<>', 'admin@admin.com')->orderby('name', 'asc')->pluck('name', 'id'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
