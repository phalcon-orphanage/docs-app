<?php

use Phalcon\Config;
use Codeception\Test\Unit;
use function Docs\Functions\{
    app_path, container, value, env, config_path, cache_path, config, environment
};
use Phalcon\{
    DiInterface, DispatcherInterface
};

class FunctionsTest extends Unit
{
    /**
     * UnitTester Object
     * @var \UnitTester
     */
    protected $tester;

    protected $appPath;
    protected $cachePath;
    protected $configPath;

    public function _before()
    {
        $this->appPath = dirname(dirname(__DIR__));
        $this->cachePath = $this->appPath . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'cache';
        $this->configPath = $this->appPath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config';
    }

    /** @test */
    public function shouldWorkWithAppPathFacade()
    {
        $this->assertEquals($this->appPath, app_path());
        $this->assertEquals($this->appPath . DIRECTORY_SEPARATOR . 'foo', app_path('foo'));
        $this->assertEquals($this->appPath . DIRECTORY_SEPARATOR . 'bar/', app_path('bar/'));

        $this->tester->amInPath(app_path());
        $this->tester->seeFileFound('functions.php', 'bootstrap');
    }

    /** @test */
    public function shouldWorkWithContainerFacade()
    {
        $this->assertInstanceOf(DiInterface::class, container());
        $this->assertInstanceOf(DispatcherInterface::class, container('dispatcher'));
    }

    /** @test */
    public function shouldWorkWithValueFacade()
    {
        $this->assertNull(value(null));
        $this->assertFalse(value(false));
        $this->assertEquals('', value(''));
        $this->assertEquals('foo', value(function () { return 'foo'; }));
    }

    /** @test */
    public function shouldWorkWithEnvFacade()
    {
        $this->assertNull(env('non-existent-key-here'));
        $this->assertTrue(true === env('non-existent-key-here', true));
        $this->assertEquals($_ENV['APP_URL'], env('APP_URL'));
    }

    /** @test */
    public function shouldWorkWithConfigPathFacade()
    {
        $this->assertEquals($this->configPath, config_path());
        $this->assertEquals($this->configPath . DIRECTORY_SEPARATOR . 'foo', config_path('foo'));
        $this->assertEquals($this->configPath . DIRECTORY_SEPARATOR . 'bar/', config_path('bar/'));

        $this->tester->amInPath(app_path('app'));
        $this->tester->seeFileFound('config');
    }

    /** @test */
    public function shouldWorkWithCachePathFacade()
    {
        $this->assertEquals($this->cachePath, cache_path());
        $this->assertEquals($this->cachePath . DIRECTORY_SEPARATOR . 'foo', cache_path('foo'));
        $this->assertEquals($this->cachePath . DIRECTORY_SEPARATOR . 'bar/', cache_path('bar/'));

        $this->tester->amInPath(app_path('storage'));
        $this->tester->seeFileFound('cache');
    }

    /** @test */
    public function shouldWorkWithConfigFacade()
    {
        $this->assertInstanceOf(Config::class, config());
        $this->assertInstanceOf(Config::class, config('app'));
        $this->assertEquals(env('APP_TIMEZONE', 'UTC'), config('app.timezone', 'UTC'));
    }

    /** @test */
    public function shouldWorkWithEnvironmentFacade()
    {
        $this->assertFalse(environment('non-existent-environment-here'));
        $this->assertFalse(environment(['non-existent-environment-here', 'non-existent-environment-here']));
        $this->assertFalse(environment([]));
        $this->assertFalse(environment(false));
        $this->assertFalse(environment(null));
        $this->assertFalse(environment('production'));
        $this->assertFalse(environment('staging'));
        $this->assertFalse(environment(['staging', 'production']));

        $this->assertTrue(environment(['staging', 'production', 'development', 'testing']));
        $this->assertTrue(environment([env('APP_ENV')]));
        $this->assertTrue(environment([$_ENV['APP_ENV']]));
        $this->assertTrue(environment() === env('APP_ENV'));
        $this->assertTrue(environment() === $_ENV['APP_ENV']);
    }
}
