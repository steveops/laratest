<?php

namespace App\Providers;

use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(GitHubManager $client)
    {
        view()->composer('repos.list', function($view) use($client){
            $user = \Auth::user()->nickname;
            $view->with([
                'repos' => $client->api('user')->repositories(\Auth::user()->nickname),
            ]);
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
