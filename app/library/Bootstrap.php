<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon                                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://phalconphp.com)          |
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

use Docs\Providers\Environment;
use Docs\Providers\ErrorHandler;
use Docs\Providers\EventsManager;
use Phalcon\Cli\Console;
use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Phalcon\Mvc\Micro;
use function Docs\Functions\config_path;
use function Docs\Functions\container;
use function Docs\Functions\env;

class Bootstrap
{
    /**
     * The internal application core.
     *
     * @var Console|Micro
     */
    private $app;

    /**
     * The application mode.
     *
     * @var string
     */
    private $mode;

    /**
     * The Dependency Injection Container
     *
     * @var DiInterface
     */
    private $container;

    /**
     * Current application environment:
     * production, staging, development, testing
     *
     * @var string
     */
    private $environment;

    /**
     * Bootstrap constructor.
     *
     * @param string $mode The application mode: "normal" or "cli".
     */
    public function __construct($mode = 'normal')
    {
        $this->mode = $mode;

        $this->container = new FactoryDefault();
        $this->container->setShared('bootstrap', $this);

        Di::setDefault($this->container);

        /**
         * These services should be registered first
         */
        $this->initializeServiceProvider(new EventsManager\ServiceProvider());
        $this->setupEnvironment();
        $this->initializeServiceProvider(new ErrorHandler\ServiceProvider());

        $this->createInternalApplication();
        $this->container->setShared('app', $this->app);

        /** @noinspection PhpIncludeInspection */
        $providers = require config_path('providers.php');
        if (is_array($providers)) {
            $this->initializeServiceProviders($providers);
        }

        $this->app->setEventsManager(container('eventsManager'));
    }

    /**
     * Initialize the Service Provider.
     *
     * Usually the Service Provider register a service in the Dependency Injector Container.
     *
     * @param  ServiceProviderInterface $serviceProvider
     *
     * @return $this
     */
    protected function initializeServiceProvider(ServiceProviderInterface $serviceProvider)
    {
        $this->container->register($serviceProvider);

        return $this;
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

        $this->initializeServiceProvider(new Environment\ServiceProvider());
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
                $this->app = new Micro($this->container);
                break;
            case 'cli':
                $this->app = new Console($this->container);
                break;
            default:
                throw new \InvalidArgumentException(
                    sprintf(
                        'Invalid application mode. Expected either "normal" or "cli". Got "%s".',
                        is_scalar($this->mode) ? $this->mode : var_export($this->mode, true)
                    )
                );
        }
    }

    /**
     * Initialize the Service Providers.
     *
     * @param  string[] $providers
     *
     * @return $this
     */
    protected function initializeServiceProviders(array $providers)
    {
        foreach ($providers as $class) {
            $this->initializeServiceProvider(new $class());
        }

        return $this;
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
     * Get application output.
     *
     * @return string
     */
    public function getOutput()
    {
        if ($this->app instanceof Micro) {
            return $this->app->handle();
        }

        // @todo Move to the "console:boot" event listener
        $arguments = [];
        if (isset($_SERVER['argv'])) {
            foreach ($_SERVER['argv'] as $index => $argument) {
                switch ($index) {
                    case 1:
                        $arguments['task'] = $argument;
                        break;
                    case 2:
                        $arguments['action'] = $argument;
                        break;
                    case 3:
                        $arguments['params'] = $argument;
                        break;
                }
            }
        }

        try {
            return $this->app->handle($arguments);
        } catch (\Exception $e) {
            // @todo Create a Handler for this
            fwrite(STDERR, PHP_EOL . $e->getMessage() . PHP_EOL);
            fwrite(STDERR, PHP_EOL . $e->getTraceAsString() . PHP_EOL . PHP_EOL);
            exit(1);
        }
    }

    /**
     * Get the Application.
     *
     * @return Console|Micro
     */
    public function getApplication()
    {
        return $this->app;
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
     * Gets current application mode: normal or cli.
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }
}
