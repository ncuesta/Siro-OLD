<?php

namespace Siro;

use \Silex\Provider;
use \SilexGravatar;
use \Gravatar;
use \Monolog\Logger;

/**
 * Application
 *
 * @author José Nahuel Cuesta Luengo <nahuelcuestaluengo@gmail.com>
 */ 
class Application extends \Silex\Application
{
    public function __construct($values = array())
    {
        parent::__construct($values);

        $this->registerProviders();
        $this->defineRoutes();
        $this->registerErrorHandlers();
    }

    /**
     * Handle an error on the application.
     *
     * @param \Exception $error
     * @param int $code
     */
    public function handleError(\Exception $error, $code)
    {
        // TODO: Implement this - but only if necessary!
        //throw $error;
    }

    /**
     * Register all service providers for this application.
     */
    protected function registerProviders()
    {
        $rootDir  = __DIR__ . '/../..';
        $cacheDir = $rootDir . '/cache';
        $logFile  = $rootDir . '/log/' . ($this['debug'] ? 'dev' : 'prod') . '.log';

        $this
            ->register(new Provider\ServiceControllerServiceProvider())
            ->register(new Provider\TwigServiceProvider())
            ->register(new Provider\UrlGeneratorServiceProvider())
            ->register(new Provider\MonologServiceProvider(), array(
                'monolog.logfile' => $logFile,
                'monolog.name'    => 'Siro',
                'monolog.level'   => $this['debug'] ? Logger::DEBUG : Logger::INFO,
            ))
            ->register(new SilexGravatar\GravatarExtension(), array(
                'gravatar.cache_dir'  => $cacheDir . '/gravatar',
                'gravatar.class_path' => $rootDir . '/vendor/fate/gravatar-php/src',
                'gravatar.options'    => array(
                    'rating'  => Gravatar\Service::RATING_G,
                    'default' => Gravatar\Service::DEFAULT_RETRO,
                ),
            ));

        if ($this['debug']) {
            $this->register(new Provider\WebProfilerServiceProvider(), array(
                'profiler.cache_dir'    => __DIR__ . '/../../cache/profiler',
                'profiler.mount_prefix' => '/_profiler',
            ));
        }
    }

    /**
     * Define the routes to be used in this application.
     */
    protected function defineRoutes()
    {
        $this->definePublicRoutes();
        $this->defineSecureRoutes();
    }

    /**
     * Define any public routes in this application.
     */
    protected function definePublicRoutes()
    {
        $this
            ->get('/', 'Siro\Controller\Homepage::index')
            ->bind('homepage');
    }

    /**
     * Define any secure routes in this application.
     */
    protected function defineSecureRoutes()
    {
        $secure = $this['controllers_factory'];

        // TODO: Define secure routes here

        // TODO: Add the before middleware:
        // $secure->before($mustBeLoggedIn);

        $this->mount('/', $secure);
    }

    /**
     * Register any needed error handler for the application.
     */
    protected function registerErrorHandlers()
    {
        $this->error(array($this, 'handleError'));
    }
}