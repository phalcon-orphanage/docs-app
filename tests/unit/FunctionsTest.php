<?php

use Codeception\Test\Unit;
use function Docs\Functions\{
    app_path, container, value, env
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
        $this->assertTrue(env('non-existent-key-here', true));
        $this->assertEquals($_ENV['APP_URL'], env('APP_URL'));
    }
}
