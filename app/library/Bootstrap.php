<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon                                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 20111-2017 Phalcon Team (https://phalconphp.com)         |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
*/

namespace Docs;

use Phalcon\Di;
use Phalcon\DiInterface;
use Phalcon\Di\FactoryDefault;
use Docs\Providers\Environment;
use Docs\Providers\ErrorHandler;
use Docs\Providers\EventsManager;
use Phalcon\Mvc\Micro as PhMicro;
use Phalcon\Di\ServiceProviderInterface;
use function Docs\Functions\env;
use function Docs\Functions\container;
use function Docs\Functions\config_path;

class Bootstrap
{
    /**
     * The internal application core.
     * @var \Phalcon\Application
     */
    private $app;

    /**
     * The application mode.
     * @var string
     */
    private $mode;

    /**
     * The Dependency Injection Container
     * @var DiInterface
     */
    private $di;

    /**
     * Current application environment:
     * production, staging, development, testing
     * @var string
     */
    private $environment;

    /**
     * Bootstrap constructor.
     *
     * @param string $mode The application mode: "normal", "cli", "api".
     */
    public function __construct($mode = 'normal')
    {
        $this->mode = $mode;

        $this->di = new FactoryDefault();
        $this->di->setShared('bootstrap', $this);

        Di::setDefault($this->di);

        /**
         * These services should be registered first
         */
        $this->initializeServiceProvider(new EventsManager\ServiceProvider($this->di));
        $this->setupEnvironment();
        $this->initializeServiceProvider(new ErrorHandler\ServiceProvider($this->di));

        $this->createInternalApplication();

        /** @noinspection PhpIncludeInspection */
        $providers = require config_path('providers.php');
        if (is_array($providers)) {
            $this->initializeServiceProviders($providers);
        }

        $this->app->setEventsManager(container('eventsManager'));

        $this->di->setShared('app', $this->app);
        $this->app->setDI($this->di);
    }

    /**
     * Runs the Application
     *
     * @return mixed
     */
    public function run()
    {
        return $this->getOutput();
    }

    /**
     * Get the Application.
     *
     * @return \Phalcon\Application|\Phalcon\Mvc\Micro
     */
    public function getApplication()
    {
        return $this->app;
    }

    /**
     * Get application output.
     *
     * @return string
     */
    public function getOutput()
    {
        if ($this->app instanceof PhMicro) {
            return $this->app->handle()->getContent();
        }

        return $this->app->handle();
    }

    /**
     * Gets current application environment: production, staging, development, testing, etc.
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Gets current application mode: normal, cli, api.
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Initialize the Service Providers.
     *
     * @param  string[] $providers
     * @return $this
     */
    protected function initializeServiceProviders(array $providers)
    {
        foreach ($providers as $name => $class) {
            $this->initializeServiceProvider(new $class($this->di));
        }

        return $this;
    }

    /**
     * Initialize the Service Provider.
     *
     * Usually the Service Provider register a service in the Dependency Injector Container.
     *
     * @param  ServiceProviderInterface $serviceProvider
     * @return $this
     */
    protected function initializeServiceProvider(ServiceProviderInterface $serviceProvider)
    {
        $serviceProvider->register($this->di);

        return $this;
    }

    /**
     * Create internal application to handle requests.
     *
     * @throws \InvalidArgumentException
     */
    protected function createInternalApplication()
    {
        switch ($this->mode) {
            case 'normal':
                $this->app = new PhMicro($this->di);
                break;
            case 'cli':
                throw new \InvalidArgumentException(
                    'Not implemented yet.'
                );
                break;
            case 'api':
                throw new \InvalidArgumentException(
                    'Not implemented yet.'
                );
            default:
                throw new \InvalidArgumentException(
                    sprintf(
                        'Invalid application mode. Expected either "normal" or "cli" or "api". Got "%s".',
                        is_scalar($this->mode) ? $this->mode : var_export($this->mode, true)
                    )
                );
        }
    }

    /**
     * Setting up the application environment.
     *
     * This tries to get `APP_ENV` environment variable from $_ENV.
     * If failed the `development` will be used.
     *
     * After getting `APP_ENV` variable we set the Bootstrap::$environment
     * and the `APPLICATION_ENV` constant which used in other Phalcon related projects eg Incubator.
     */
    protected function setupEnvironment()
    {
        $this->environment = env('APP_ENV', 'development');

        defined('APPLICATION_ENV') || define('APPLICATION_ENV', $this->environment);

        $this->initializeServiceProvider(new Environment\ServiceProvider($this->di));
    }
}
