<?php

namespace App\Services\Html;

use Illuminate\Html\HtmlServiceProvider as ServiceProvider;

class HtmlServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerHtmlBuilder();
        $this->registerFormBuilder();
        $this->registerBlenderBuilder();

        $this->app->alias('html', HtmlBuilder::class);
        $this->app->alias('form', FormBuilder::class);
    }

    /**
     * Register the HTML builder instance.
     */
    protected function registerHtmlBuilder()
    {
        $this->app->bindShared('html', function ($app) {
            return new HtmlBuilder($app['url']);
        });
    }

    /**
     * Register the form builder instance.
     */
    protected function registerFormBuilder()
    {
        $this->app->bindShared('form', function ($app) {
            $formBuilder = new FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            $formBuilder->setSessionStore($app['session.store']);

            return $formBuilder;
        });
    }

    /**
     * Register the blender builder instance.
     */
    protected function registerBlenderBuilder()
    {
        $this->app->singleton(BlenderBuilder::class);
    }
}
